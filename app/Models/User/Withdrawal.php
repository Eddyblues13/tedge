<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = [
        'user_id',
        'account_type',
        'method',
        'crypto_currency',
        'amount',
        'wallet_address',
        'bank_name',
        'account_name',
        'account_number',
        'routing_number',
        'swift_code',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function isBank(): bool
    {
        return $this->method === 'bank';
    }
}
