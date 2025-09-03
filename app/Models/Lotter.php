<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lotter extends Model
{
   protected $fillable = [
        'name',
        'price',
        'description',
        'photo',
        'status',
        'draw_date',
        'first_prize',
        'second_prize',
        'third_prize',
        'win_type',
    ];

    protected $casts = [
        'draw_date' => 'datetime',
    ];



    protected $dates = ['draw_date'];
     public function userPackageBuys()
    {
        return $this->hasMany(Userpackagebuy::class, 'package_id');
    }

public function lotteryResults()
{
    return $this->hasMany(Lottery_result::class, 'user_package_buy_id', 'id');
}

// Userpackagebuy.php
public function user()
{
    return $this->belongsTo(User::class);
}
public function lottery()
{
    return $this->belongsTo(Lotter::class, 'package_id');
}
public function result()
{
    return $this->hasOne(Lottery_result::class, 'user_package_buy_id');
}
public function buys()
{
    return $this->hasMany(Userpackagebuy::class, 'package_id');
}
public function results()
{
    return $this->hasMany(Lottery_result::class);
}


}
