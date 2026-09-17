<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Trader;
use App\Models\TradingHistory;
use Illuminate\Support\Facades\DB;
use App\Models\User\TradingBalance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminActionNotificationMail;
use App\Models\AdminNotification;

class CopiedTradeController extends Controller
{
    /**
     * Display all copied traders
     */
    public function index()
    {
        $tradingHistory = TradingHistory::with(['trader' => function ($query) {
            $query->select('id', 'name', 'picture', 'return_rate');
        }])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.copied-traders', [
            'tradingHistory' => $tradingHistory,
            'tradingBalance' => $this->getTradingBalance()
        ]);
    }

    /**
     * Stop copying a trader
     */
    public function stop(Request $request)
    {
        $request->validate([
            'trade_id' => 'required|exists:trading_histories,id'
        ]);

        try {
            DB::beginTransaction();

            $trade = TradingHistory::where('user_id', Auth::id())
                ->where('id', $request->trade_id)
                ->where('status', 'active')
                ->firstOrFail();

            // Refund the amount to trading balance
            TradingBalance::create([
                'user_id' => Auth::id(),
                'amount' => $trade->amount
            ]);

            // Update trade status
            $trade->update([
                'status' => 'closed',
                'closed_at' => now()
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Successfully stopped copying this trader',
                'refund_amount' => $trade->amount
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to stop trade: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Copy a new trader
     */
    public function copyTrader(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'trader_id' => 'required|exists:traders,id',
            'amount' => 'nullable'
        ]);



        try {
            DB::beginTransaction();

            // Check available balance
            $currentBalance = $this->getTradingBalance();

            if ($currentBalance < $validated['amount']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient trading balance. Your balance: $' . number_format($currentBalance, 2)
                ], 400);
            }

            //Decrement trading balance
            TradingBalance::where('user_id', $user->id)
                ->decrement('amount', $validated['amount']);

            // Create trading history record
            $trade = TradingHistory::create([
                'user_id' => $user->id,
                'trader_id' => $validated['trader_id'],
                'amount' => $validated['amount'],
                'status' => 'active'
            ]);

            // Notify admin about the copy trade
            try {
                $trader = Trader::find($validated['trader_id']);
                Mail::to('support@Tradedgepip.live')->send(new AdminActionNotificationMail(
                    'Copy Trade',
                    trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: 'Unknown User',
                    $user->email,
                    $validated['amount'],
                    [
                        'Trader Copied' => $trader->name ?? 'Trader #' . $validated['trader_id'],
                        'Trade ID' => '#' . $trade->id,
                        'Status' => 'Active',
                    ]
                ));
            } catch (\Throwable $e) {
                \Log::error('Admin copy trade notification email failed: ' . $e->getMessage());
            }

            // Create in-app admin notification
            AdminNotification::create([
                'type' => 'Copy Trade',
                'title' => 'New Copy Trade',
                'message' => (trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: 'A user') . ' started a $' . number_format($validated['amount'], 2) . ' copy trade on ' . ($trader->name ?? 'Trader #' . $validated['trader_id']) . '.',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Successfully copied trader',
                'new_balance' => $currentBalance,
                'trade_id' => 2,
                'new_balance' => $currentBalance - $validated['amount'],
                'trade_id' => $trade->id
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Copy trade error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to copy trader: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user's current trading balance
     */
    private function getTradingBalance()
    {
        return TradingBalance::where('user_id', Auth::id())
            ->sum('amount') ?? 0;
    }
}
