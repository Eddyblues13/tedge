<?php

namespace App\Http\Controllers\User;

use App\Models\Trader;
use App\Models\User\Profit;
use App\Models\User\Deposit;
use Illuminate\Http\Request;
use App\Models\TradingHistory;
use Illuminate\Support\Facades\DB;
use App\Models\User\HoldingBalance;
use App\Models\User\StakingBalance;
use App\Models\User\TradingBalance;
use App\Http\Controllers\Controller;
use App\Models\User\ReferralBalance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminActionNotificationMail;
use App\Models\AdminNotification;

class CopyTradeController extends Controller
{
    public function index()
    {
        $traders = Trader::all();
        $tradingHistories = TradingHistory::where('user_id', Auth::id())->with('trader')->get();
        $user = Auth::user();

        $data['holdingBalance'] = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['stakingBalance'] = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['tradingBalance'] = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['referralBalance'] = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['depositBalance'] = Deposit::where('user_id', $user->id)
            ->where('status', 'approved') // Only include approved deposits
            ->sum('amount') ?? 0;
        $data['profit'] = Profit::where('user_id', $user->id)->sum('amount') ?? 0;

        $data['totalBalance'] =    $data['holdingBalance'] +  $data['stakingBalance'] +   $data['tradingBalance']  +  $data['referralBalance'] +  $data['depositBalance'] +  $data['profit'];

        return view('user.copy_trade', compact('traders'), $data);
    }

    public function copyTrader(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to copy traders'
            ], 401);
        }

        $validated = $request->validate([
            'trader_id' => 'required|exists:traders,id',
            'amount' => 'nullable'
        ]);


        $traderId = $validated['trader_id'];
        $amount = $validated['amount'];

        try {
            DB::beginTransaction();

            // Get current balance
            $currentBalance = TradingBalance::where('user_id', $user->id)
                ->sum('amount');

            if ($currentBalance < $amount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient trading balance. Your balance: $' . number_format($currentBalance, 2)
                ], 400);
            }

            // Find a positive balance record to decrement
            $balanceRecord = TradingBalance::where('user_id', $user->id)
                ->where('amount', '>', 0)
                ->orderBy('created_at', 'asc') // FIFO approach
                ->first();

            if (!$balanceRecord) {
                return response()->json([
                    'success' => false,
                    'message' => 'No available balance to deduct from'
                ], 400);
            }

            // Decrement the balance
            $balanceRecord->decrement('amount', $amount);

            // Record the transaction
            $transaction = TradingHistory::create([
                'user_id' => $user->id,
                'trader_id' => $traderId,
                'amount' => $amount,
                'status' => 'active',

            ]);

            // Notify admin about the copy trade
            try {
                $trader = Trader::find($traderId);
                Mail::to('support@Tradedgepip.live')->send(new AdminActionNotificationMail(
                    'Copy Trade',
                    trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: 'Unknown User',
                    $user->email,
                    $amount,
                    [
                        'Trader Copied' => $trader->name ?? 'Trader #' . $traderId,
                        'Trade ID' => '#' . $transaction->id,
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
                'message' => (trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: 'A user') . ' started a $' . number_format($amount, 2) . ' copy trade on ' . ($trader->name ?? 'Trader #' . $traderId) . '.',
            ]);

            DB::commit();

            $newBalance = $currentBalance - $amount;


            return response()->json([
                'success' => true,
                'message' => 'Successfully copied trader',
                'new_balance' => $newBalance,
                'transaction_id' => $transaction->id
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
}
