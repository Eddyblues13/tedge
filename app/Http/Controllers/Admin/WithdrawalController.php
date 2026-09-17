<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\User\Profit;
use App\Models\User\Deposit;
use App\Models\User\Withdrawal;
use App\Models\User\HoldingBalance;
use App\Models\User\StakingBalance;
use App\Models\User\TradingBalance;
use App\Models\User\ReferralBalance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{
    public function index(Request $request)
    {
        $withdrawals = Withdrawal::with('user')
            ->when($request->status, function ($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->latest()
            ->get();

        $totalWithdrawals = Withdrawal::count();
        $pendingCount     = Withdrawal::where('status', 'pending')->count();
        $approvedCount    = Withdrawal::where('status', 'approved')->count();
        $rejectedCount    = Withdrawal::where('status', 'rejected')->count();
        $pendingVolume    = Withdrawal::where('status', 'pending')->sum('amount');

        return view('admin.withdrawals.index', compact(
            'withdrawals',
            'totalWithdrawals',
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'pendingVolume'
        ));
    }

    public function approve($id)
    {
        try {
            $withdrawal = Withdrawal::findOrFail($id);

            if ($withdrawal->status != 'pending') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Withdrawal has already been processed'
                ], 400);
            }

            // Update withdrawal status
            $withdrawal->update(['status' => 'approved']);

            return response()->json([
                'status' => 'success',
                'message' => 'Withdrawal approved successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error approving withdrawal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function reject($id)
    {
        try {
            $withdrawal = Withdrawal::findOrFail($id);

            if ($withdrawal->status != 'pending') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Withdrawal has already been processed'
                ], 400);
            }

            DB::beginTransaction();

            // Refund the amount back to the user's account
            $userId     = $withdrawal->user_id;
            $amount     = $withdrawal->amount;
            $accountType = $withdrawal->account_type;

            switch ($accountType) {
                case 'holding':
                    HoldingBalance::where('user_id', $userId)->increment('amount', $amount);
                    break;
                case 'trading':
                    TradingBalance::where('user_id', $userId)->increment('amount', $amount);
                    break;
                case 'staking':
                    StakingBalance::where('user_id', $userId)->increment('amount', $amount);
                    break;
                case 'referral':
                    ReferralBalance::where('user_id', $userId)->increment('amount', $amount);
                    break;
                case 'profit':
                    Profit::where('user_id', $userId)->increment('amount', $amount);
                    break;
                case 'deposit':
                    Deposit::where('user_id', $userId)
                        ->where('status', 'approved')
                        ->latest()
                        ->first()
                        ?->increment('amount', $amount);
                    break;
            }

            // Update withdrawal status
            $withdrawal->update(['status' => 'rejected']);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Withdrawal rejected and amount refunded!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Error rejecting withdrawal: ' . $e->getMessage()
            ], 500);
        }
    }
}
