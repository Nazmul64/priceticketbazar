<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_profit extends Model
{
    protected $table =[
        'user_id',
        'total_deposit',
        'total_profit',
    ];
}
