<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_widthdraw extends Model
{
    protected $fillable = [
        'user_id',
        'wallet_name',
        'amount',
        'status',
        'amount',
        'charge',
        'account_number',
    ];

}
