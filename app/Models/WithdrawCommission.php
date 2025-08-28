<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawCommission extends Model
{
    protected $fillable = [
        'withdraw_commission',
        'money_exchange_commission',
        'status',
    ];
}
