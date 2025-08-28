<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Lottery;

class Userpackagebuy extends Model
{
   protected $fillable = [
        'user_id',
        'package_id',
        'price',
        'status',
        'purchased_at',
    ];

    protected $casts = [
        'purchased_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Lotter::class, 'package_id');
    }

    public function results()
    {
        return $this->hasMany(Lottery_result::class, 'user_package_buy_id');
    }

public function userPackageBuys()
{
    return $this->hasMany(Userpackagebuy::class, 'package_id');
}


}
