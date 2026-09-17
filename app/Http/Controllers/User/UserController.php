<?php

namespace App\Http\Controllers\User;

use App\Models\User\Profit;
use App\Models\User\Deposit;
use Illuminate\Http\Request;
use App\Models\User\MiningBalance;
use App\Models\User\HoldingBalance;
use App\Models\User\StakingBalance;
use App\Models\User\TradingBalance;
use App\Http\Controllers\Controller;
use App\Models\User\ReferralBalance;
use App\Models\Trade;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Allowed trading symbols
    private $allowedSymbols = [
        // Forex
        'AUDBRL',
        'AUDCAD',
        'AUDCHF',
        'AUDJPY',
        'AUDNZD',
        'AUDUSD',
        'CADJPY',
        'CHFZAR',
        'EURAUD',
        'EURBRL',
        'EURCAD',
        'EURCHF',
        'EURGBP',
        'EURJPY',
        'EURUSD',
        'GBPAUD',
        'GBPCAD',
        'GBPCHF',
        'GBPJPY',
        'GBPUSD',
        'NZDUSD',
        'USDCAD',
        'USDCHF',
        'USDJPY',
        'USDZAR',
        // Crypto
        'BTCUSD',
        'ETHUSD',
        'XRPUSD',
        'SOLUSD',
        'BNBUSD',
        'ADAUSD',
        'DOGEUSD',
        'TRXUSD',
        'DOTUSD',
        'LINKUSD',
        'MATICUSD',
        'AVAXUSD',
        'LTCUSD',
        'ATOMUSD',
        'UNIUSD',
        'XLMUSD',
        'ALGOUSD',
        'NEARUSD',
        'FILUSD',
        'AAVEUSD',
        'APTUSD',
        'ARBUSD',
        'OPUSD',
        'MKRUSD',
        'INJUSD',
        'RNDRUSD',
        'SUIUSD',
        'SHIBUSD',
        'PEPEUSD',
        'TONUSD',
        // Stocks
        'AAPL',
        'MSFT',
        'TSLA',
        'NVDA',
        'AMZN',
        'GOOGL',
        'META',
        'BRK.B',
        'LLY',
        'V',
        'JPM',
        'WMT',
        'MA',
        'PG',
        'HD',
        'XOM',
        'JNJ',
        'COST',
        'ABBV',
        'CRM',
        'NFLX',
        'ORCL',
        'AMD',
        'INTC',
        'DIS',
        'BA',
        'UBER',
        'PYPL',
        'SQ',
        'COIN',
        // ETFs
        'SPY',
        'QQQ',
        'IWM',
        'DIA',
        'VTI',
        'VOO',
        'VEA',
        'VWO',
        'GLD',
        'SLV',
        'TLT',
        'XLF',
        'XLK',
        'ARKK',
        'EEM',
    ];

    public function index(Request $request)
    {
        $user = Auth::user();


        $data['user'] = Auth::user();

        $data['holdingBalance'] = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['stakingBalance'] = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['tradingBalance'] = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['referralBalance'] = ReferralBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $data['depositBalance'] = Deposit::where('user_id', $user->id)
            ->where('status', 'approved') // Only include approved deposits
            ->sum('amount') ?? 0;
        $data['profit'] = Profit::where('user_id', $user->id)->sum('amount') ?? 0;

        $data['totalBalance'] =
            $data['holdingBalance'] +
            $data['stakingBalance'] +
            $data['tradingBalance'] +
            $data['referralBalance'] +
            $data['profit'];





        $data['openTrades'] = $user->trades()
            ->where('status', 'active')
            ->orderBy('entry_date', 'desc')
            ->get();

        $data['closedTrades'] = $user->trades()
            ->where('status', 'closed')
            ->orderBy('exit_date', 'desc')
            ->get();





        return view('user.home', $data);
    }

    public function profile()
    {
        $user = Auth::user();
        // Get the last assigned plan from PlanHistory
        $lastPlanHistory = \App\Models\User\PlanHistory::where('user_id', $user->id)
            ->with('plan')
            ->orderBy('created_at', 'desc')
            ->first();
        $activePlanName = $lastPlanHistory && $lastPlanHistory->plan ? $lastPlanHistory->plan->name : null;
        return view('user.profile', compact('activePlanName'));
    }


    public function holding()
    {

        $user = Auth::user();

        $holdingBalance = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $stakingBalance = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $tradingBalance = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        $totalBalance = $holdingBalance + $stakingBalance + $tradingBalance;

        return view('user.holding', compact('holdingBalance'));
    }

    public function assetDetail($symbol)
    {
        return view('user.asset_detail', compact('symbol'));
    }

    public function trading()
    {

        $user = Auth::user();


        $tradingBalance = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;



        return view('user.trading', compact('tradingBalance'));
    }

    public function tradingAsset($symbol)
    {
        $symbol = strtoupper($symbol);

        // Validate symbol exists in allowed list
        if (!in_array($symbol, $this->allowedSymbols)) {
            return redirect()->route('trading')->with('error', 'Invalid trading symbol.');
        }

        $user = Auth::user();
        $tradingBalance = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        // Get open trades for this user
        $openTrades = Trade::where('user_id', $user->id)
            ->where('status', 'active')
            ->count();

        return view('user.trading_asset', compact('tradingBalance', 'symbol', 'openTrades'));
    }

    public function placeTrade(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'symbol' => 'required|string',
            'direction' => 'required|in:up,down',
            'amount' => 'required|numeric|min:0.01',
            'leverage' => 'required|integer|min:1|max:250',
            'time' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $symbol = strtoupper($request->symbol);

        // Validate symbol
        if (!in_array($symbol, $this->allowedSymbols)) {
            return response()->json(['success' => false, 'message' => 'Invalid trading symbol.'], 400);
        }

        // Check trading balance
        $tradingBalance = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        if ($request->amount > $tradingBalance) {
            return response()->json(['success' => false, 'message' => 'Insufficient trading balance. Your balance is $' . number_format($tradingBalance, 2)], 400);
        }

        // Determine asset type
        $forexPairs = [
            'AUDBRL',
            'AUDCAD',
            'AUDCHF',
            'AUDJPY',
            'AUDNZD',
            'AUDUSD',
            'CADJPY',
            'CHFZAR',
            'EURAUD',
            'EURBRL',
            'EURCAD',
            'EURCHF',
            'EURGBP',
            'EURJPY',
            'EURUSD',
            'GBPAUD',
            'GBPCAD',
            'GBPCHF',
            'GBPJPY',
            'GBPUSD',
            'NZDUSD',
            'USDCAD',
            'USDCHF',
            'USDJPY',
            'USDZAR'
        ];

        if (in_array($symbol, $forexPairs)) {
            $type = 'forex';
        } elseif (str_ends_with($symbol, 'USD') && !in_array($symbol, $forexPairs)) {
            $type = 'crypto';
        } else {
            $type = 'stocks';
        }

        // Create trade
        $trade = Trade::create([
            'user_id' => $user->id,
            'symbol' => $symbol,
            'type' => $type,
            'direction' => $request->direction,
            'entry_price' => $request->price,
            'exit_price' => null,
            'amount' => $request->amount,
            'profit' => 0,
            'status' => 'active',
            'entry_date' => now(),
            'exit_date' => null,
            'trader_name' => null,
            'notes' => 'Leverage: ' . $request->leverage . 'x, Time: ' . $request->time . ' min',
        ]);

        // Deduct from trading balance
        TradingBalance::create([
            'user_id' => $user->id,
            'amount' => -$request->amount,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Trade placed successfully!',
            'trade_id' => $trade->id,
        ]);
    }

    public function staking()
    {

        $user = Auth::user();

        $holdingBalance = HoldingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $stakingBalance = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;
        $tradingBalance = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        $totalBalance = $holdingBalance + $stakingBalance + $tradingBalance;

        return view('user.staking', compact('stakingBalance'));
    }

    public function tradeDetail($id)
    {
        $user = Auth::user();
        $trade = Trade::where('user_id', $user->id)->findOrFail($id);

        return view('user.trade_detail', compact('trade'));
    }

    public function stakingDetail($pair)
    {
        $user = Auth::user();
        $stakingBalance = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        return view('user.staking_detail', compact('pair', 'stakingBalance'));
    }

    public function stakingSubmit(Request $request, $pair)
    {
        $user = Auth::user();
        $stakingBalance = StakingBalance::where('user_id', $user->id)->sum('amount') ?? 0;

        $amount = $request->input('amount');
        $period = $request->input('period', 30);

        if ($amount <= 0) {
            return back()->with('error', 'Please enter a valid amount.');
        }

        if ($amount > $stakingBalance) {
            return back()->with('error', 'Insufficient staking balance.');
        }

        return back()->with('success', 'Staking request submitted successfully.');
    }

    public function currentTrade()
    {

        $user = Auth::user();


        $tradingBalance = TradingBalance::where('user_id', $user->id)->sum('amount') ?? 0;



        return view('user.current_trade', compact('tradingBalance'));
    }

    public function mining()
    {

        $user = Auth::user();


        $miningBalance = MiningBalance::where('user_id', $user->id)->sum('amount') ?? 0;



        return view('user.mining', compact('miningBalance'));
    }
}
