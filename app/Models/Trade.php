<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'symbol',
        'type',
        'direction',
        'entry_price',
        'exit_price',
        'amount',
        'profit',
        'status',
        'entry_date',
        'exit_date',
        'trader_name',
        'notes'
    ];

    protected $casts = [
        'entry_date' => 'datetime',
        'exit_date' => 'datetime',
        'entry_price' => 'float',
        'exit_price' => 'float',
        'amount' => 'float',
        'profit' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSymbolIconAttribute()
    {
        $symbol = strtoupper($this->symbol ?? '');

        // Forex pairs - return empty (handled by flags in view)
        $forexPairs = ['AUDBRL','AUDCAD','AUDCHF','AUDJPY','AUDNZD','AUDUSD','CADJPY','CHFZAR',
            'EURAUD','EURBRL','EURCAD','EURCHF','EURGBP','EURJPY','EURUSD','GBPAUD',
            'GBPCAD','GBPCHF','GBPJPY','GBPUSD','NZDUSD','USDCAD','USDCHF','USDJPY','USDZAR'];

        if (in_array($symbol, $forexPairs)) {
            return 'forex';
        }

        // Crypto logos
        $cryptoLogos = [
            'BTCUSD' => 'bitcoin-btc', 'ETHUSD' => 'ethereum-eth', 'XRPUSD' => 'xrp-xrp',
            'SOLUSD' => 'solana-sol', 'BNBUSD' => 'bnb-bnb', 'ADAUSD' => 'cardano-ada',
            'DOGEUSD' => 'dogecoin-doge', 'TRXUSD' => 'tron-trx', 'DOTUSD' => 'polkadot-new-dot',
            'LINKUSD' => 'chainlink-link', 'MATICUSD' => 'polygon-matic', 'AVAXUSD' => 'avalanche-avax',
            'LTCUSD' => 'litecoin-ltc', 'ATOMUSD' => 'cosmos-atom', 'UNIUSD' => 'uniswap-uni',
            'XLMUSD' => 'stellar-xlm', 'ALGOUSD' => 'algorand-algo', 'NEARUSD' => 'near-protocol-near',
            'FILUSD' => 'filecoin-fil', 'AAVEUSD' => 'aave-aave', 'APTUSD' => 'aptos-apt',
            'ARBUSD' => 'arbitrum-arb', 'OPUSD' => 'optimism-ethereum-op', 'MKRUSD' => 'maker-mkr',
            'INJUSD' => 'injective-inj', 'RNDRUSD' => 'render-token-rndr', 'SUIUSD' => 'sui-sui',
            'SHIBUSD' => 'shiba-inu-shib', 'PEPEUSD' => 'pepe-pepe', 'TONUSD' => 'toncoin-ton',
        ];

        if (isset($cryptoLogos[$symbol])) {
            return "https://cryptologos.cc/logos/{$cryptoLogos[$symbol]}-logo.png";
        }

        // Stock / ETF logos via Clearbit
        $stockDomains = [
            'AAPL' => 'apple.com', 'MSFT' => 'microsoft.com', 'TSLA' => 'tesla.com',
            'NVDA' => 'nvidia.com', 'AMZN' => 'amazon.com', 'GOOGL' => 'google.com', 'META' => 'meta.com',
            'BRK.B' => 'berkshirehathaway.com', 'LLY' => 'lilly.com', 'V' => 'visa.com',
            'JPM' => 'jpmorganchase.com', 'WMT' => 'walmart.com', 'MA' => 'mastercard.com',
            'PG' => 'pg.com', 'HD' => 'homedepot.com', 'XOM' => 'exxonmobil.com',
            'JNJ' => 'jnj.com', 'COST' => 'costco.com', 'ABBV' => 'abbvie.com', 'CRM' => 'salesforce.com',
            'NFLX' => 'netflix.com', 'ORCL' => 'oracle.com', 'AMD' => 'amd.com', 'INTC' => 'intel.com',
            'DIS' => 'thewaltdisneycompany.com', 'BA' => 'boeing.com', 'UBER' => 'uber.com',
            'PYPL' => 'paypal.com', 'SQ' => 'squareup.com', 'COIN' => 'coinbase.com',
        ];

        if (isset($stockDomains[$symbol])) {
            return "https://logo.clearbit.com/{$stockDomains[$symbol]}";
        }

        // Fallback
        return '';
    }

    public function getFormattedProfitAttribute()
    {
        $currencySymbol = config('currencies.' . $this->user->currency, '$');
        return $currencySymbol . number_format($this->profit, 2);
    }

    public function getFormattedAmountAttribute()
    {
        $currencySymbol = config('currencies.' . $this->user->currency, '$');
        return $currencySymbol . number_format($this->amount, 2);
    }

    public function getFormattedEntryPriceAttribute()
    {
        return number_format($this->entry_price, 4);
    }

    public function getFormattedExitPriceAttribute()
    {
        return $this->exit_price ? number_format($this->exit_price, 4) : null;
    }
}
