<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\User\Deposit;
use App\Models\User\HoldingBalance;
use App\Models\User\TradingBalance;
use App\Models\User\MiningBalance;
use App\Models\User\StakingBalance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with('user')->latest()->get();

        $totalDeposits = $deposits->count();
        $pendingCount = $deposits->where('status', 'pending')->count();
        $approvedCount = $deposits->where('status', 'approved')->count();
        $rejectedCount = $deposits->where('status', 'rejected')->count();
        $approvedVolume = $deposits->where('status', 'approved')->sum('amount');

        return view('admin.deposits.index', compact(
            'deposits',
            'totalDeposits',
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'approvedVolume'
        ));
    }

    public function approve($id)
    {
        try {
            $deposit = Deposit::findOrFail($id);

            if ($deposit->status != 'pending') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Deposit has already been processed'
                ], 400);
            }

            $deposit->update(['status' => 'approved']);

            $user = User::findOrFail($deposit->user_id);

            // 1. Credit the specific account type balance
            switch ($deposit->account_type) {
                case 'holding':
                    $balance = HoldingBalance::firstOrCreate(
                        ['user_id' => $user->id],
                        ['amount' => 0]
                    );
                    $balance->increment('amount', $deposit->amount);
                    break;
                case 'trading':
                    $balance = TradingBalance::firstOrCreate(
                        ['user_id' => $user->id],
                        ['amount' => 0]
                    );
                    $balance->increment('amount', $deposit->amount);
                    break;
                case 'mining':
                    $balance = MiningBalance::firstOrCreate(
                        ['user_id' => $user->id],
                        ['amount' => 0]
                    );
                    $balance->increment('amount', $deposit->amount);
                    break;
                case 'staking':
                    $balance = StakingBalance::firstOrCreate(
                        ['user_id' => $user->id],
                        ['amount' => 0]
                    );
                    $balance->increment('amount', $deposit->amount);
                    break;
                default:
                    throw new \Exception("Unknown account type: {$deposit->account_type}");
            }

            // 2. Also increment the deposit balance (so deposit balance total goes up)
            $depositBalance = Deposit::firstOrCreate(
                ['user_id' => $user->id, 'account_type' => $deposit->account_type, 'status' => 'approved'],
                ['amount' => 0]
            );
            // Only increment if this is a different record than the one we just approved
            if ($depositBalance->id !== $deposit->id) {
                $depositBalance->increment('amount', $deposit->amount);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Deposit approved! ' . ucfirst($deposit->account_type) . ' balance and deposit balance credited with $' . number_format($deposit->amount, 2)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error approving deposit: ' . $e->getMessage()
            ], 500);
        }
    }

    public function reject($id)
    {
        try {
            $deposit = Deposit::findOrFail($id);

            if ($deposit->status != 'pending') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Deposit has already been processed'
                ], 400);
            }

            $deposit->update(['status' => 'rejected']);

            return response()->json([
                'status' => 'success',
                'message' => 'Deposit rejected successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error rejecting deposit: ' . $e->getMessage()
            ], 500);
        }
    }
}
