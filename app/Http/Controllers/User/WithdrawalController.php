<?php

namespace App\Http\Controllers\User;

use App\Models\User\Profit;
use App\Models\User\Deposit;
use Illuminate\Http\Request;
use App\Models\User\Withdrawal;
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

class WithdrawalController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $data = $this->balances($user->id);
        // Fetch withdrawals for the authenticated user
        $data['withdrawals'] = Withdrawal::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('user.withdrawal', $data);
    }

    public function cryptoWithdrawal()
    {
        return view('user.crypto_withdrawal', $this->balances(Auth::id()));
    }

    public function bankWithdrawal()
    {
        return view('user.bank_withdrawal', $this->balances(Auth::id()));
    }

    /**
     * Balances shown in the withdrawal pages' account selector.
     */
    private function balances($userId): array
    {
        $data['holdingBalance'] = HoldingBalance::where('user_id', $userId)->sum('amount') ?? 0;
        $data['stakingBalance'] = StakingBalance::where('user_id', $userId)->sum('amount') ?? 0;
        $data['tradingBalance'] = TradingBalance::where('user_id', $userId)->sum('amount') ?? 0;
        $data['referralBalance'] = ReferralBalance::where('user_id', $userId)->sum('amount') ?? 0;
        $data['depositBalance'] = Deposit::where('user_id', $userId)
            ->where('status', 'approved') // Only include approved deposits
            ->sum('amount') ?? 0;
        $data['profit'] = Profit::where('user_id', $userId)->sum('amount') ?? 0;

        $data['totalBalance'] =    $data['holdingBalance'] +  $data['stakingBalance'] +   $data['tradingBalance']  +  $data['referralBalance'] +  $data['depositBalance'] +  $data['profit'];

        return $data;
    }

    public function submit(Request $request)
    {
        // Requests without a method come from the original crypto-only form
        $request->merge(['method' => $request->input('method') ?: 'crypto']);

        // Validate the request
        $request->validate([
            'method' => 'required|string|in:crypto,bank',
            'account' => 'required|string|in:trading,holding,staking,referral,profit,deposit',
            'amount' => 'required|numeric|min:0.01',
            'crypto_currency' => 'required_if:method,crypto|nullable|string|in:btc,usdt,eth',
            'wallet_address' => 'required_if:method,crypto|nullable|string|max:255',
            'bank_name' => 'required_if:method,bank|nullable|string|max:255',
            'account_name' => 'required_if:method,bank|nullable|string|max:255',
            'account_number' => 'required_if:method,bank|nullable|string|max:50',
            'routing_number' => 'nullable|string|max:50',
            'swift_code' => 'nullable|string|max:20',
        ], [
            'required_if' => 'The :attribute field is required.',
        ]);

        $user = Auth::user();
        $amount = $request->input('amount');
        $accountType = $request->input('account');
        $method = $request->input('method');

        // Payout destination fields for the chosen method
        if ($method === 'bank') {
            $destination = [
                'bank_name' => $request->input('bank_name'),
                'account_name' => $request->input('account_name'),
                'account_number' => $request->input('account_number'),
                'routing_number' => $request->input('routing_number'),
                'swift_code' => $request->input('swift_code'),
            ];
            $destinationDetails = array_filter([
                'Method' => 'Bank Transfer',
                'Bank Name' => $destination['bank_name'],
                'Account Name' => $destination['account_name'],
                'Account Number' => $destination['account_number'],
                'Routing / Sort Code' => $destination['routing_number'],
                'SWIFT / BIC' => $destination['swift_code'],
            ]);
            $methodLabel = 'Bank Transfer';
        } else {
            $destination = [
                'crypto_currency' => $request->input('crypto_currency'),
                'wallet_address' => $request->input('wallet_address'),
            ];
            $destinationDetails = [
                'Method' => 'Crypto',
                'Crypto Currency' => strtoupper($destination['crypto_currency']),
                'Wallet Address' => $destination['wallet_address'],
            ];
            $methodLabel = strtoupper($destination['crypto_currency']);
        }

        // Fetch user balances
        $holdingBalance = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $stakingBalance = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $tradingBalance = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $referralBalance = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        $data['depositBalance'] = Deposit::where('user_id', $user->id)
            ->where('status', 'approved') // Only include approved deposits
            ->sum('amount') ?? 0;
        $data['profit'] = Profit::where('user_id', $user->id)->sum('amount') ?? 0;

        // Validate the withdrawal amount
        // switch ($accountType) {
        //     case 'holding':
        //         if ($amount > $holdingBalance) {
        //             return response()->json(['message' => 'Insufficient balance in Holding Account.'], 400);
        //         }
        //         break;
        //     case 'staking':
        //         if ($amount > $stakingBalance) {
        //             return response()->json(['message' => 'Insufficient balance in Staking Account.'], 400);
        //         }
        //         break;
        //     case 'trading':
        //         if ($amount > $tradingBalance) {
        //             return response()->json(['message' => 'Insufficient balance in Trading Account.'], 400);
        //         }
        //     case 'referral':
        //         if ($amount > $tradingBalance) {
        //             return response()->json(['message' => 'Insufficient balance in Referral Account.'], 400);
        //         }
        //     case 'profit':
        //         if ($amount > $tradingBalance) {
        //             return response()->json(['message' => 'Insufficient balance in Profit Account.'], 400);
        //         }
        //     case 'deposit':
        //         if ($amount > $tradingBalance) {
        //             return response()->json(['message' => 'Insufficient balance in Deposit Account.'], 400);
        //         }
        //         break;
        //     default:
        //         return response()->json(['message' => 'Invalid account selected.'], 400);
        // }

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Deduct the amount from the selected account
            switch ($accountType) {
                case 'holding':
                    HoldingBalance::where('user_id', $user->id)->decrement('amount', $amount);
                    break;
                case 'staking':
                    StakingBalance::where('user_id', $user->id)->decrement('amount', $amount);
                    break;
                case 'trading':
                    TradingBalance::where('user_id', $user->id)->decrement('amount', $amount);
                    break;
                case 'referral':
                    ReferralBalance::where('user_id', $user->id)->decrement('amount', $amount);
                    break;
                case 'profit':
                    Profit::where('user_id', $user->id)->decrement('amount', $amount);
                    break;
                case 'deposit':
                    Deposit::where('user_id', $user->id)->decrement('amount', $amount);
                    break;
            }

            // Create a new withdrawal record
            Withdrawal::create(array_merge([
                'user_id' => $user->id,
                'account_type' => $accountType,
                'method' => $method,
                'amount' => $amount,
                'status' => 'pending', // Default status
            ], $destination));

            // Notify admin about the new withdrawal request
            try {
                Mail::to('support@Tradedgepip.live')->send(new AdminActionNotificationMail(
                    'Withdrawal',
                    trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: 'Unknown User',
                    $user->email,
                    $amount,
                    array_merge(
                        ['Account Type' => ucfirst($accountType)],
                        $destinationDetails,
                        ['Status' => 'Pending']
                    )
                ));
            } catch (\Throwable $e) {
                \Log::error('Admin withdrawal notification email failed: ' . $e->getMessage());
            }

            // Create in-app admin notification
            AdminNotification::create([
                'type' => 'Withdrawal',
                'title' => 'New Withdrawal Request',
                'message' => (trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: 'A user') . ' requested a $' . number_format($amount, 2) . ' withdrawal (' . $methodLabel . ').',
            ]);

            // Commit the transaction
            DB::commit();
            // Set a session flag to show the notification
            session()->flash('show_notification', true);
            session()->flash('withdrawal_method', $method);
            return response()->json([
                'message' => 'Withdrawal request submitted successfully!',
                'redirect' => route('withdrawal'), // Redirect to the withdrawal page
            ]);
        } catch (\Throwable $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
            \Log::error('Withdrawal submission error: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred. Please try again.'], 500);
        }
    }
}
