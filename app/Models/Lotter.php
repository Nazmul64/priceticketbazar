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

    public function buys()
    {
        return $this->hasMany(Userpackagebuy::class, 'package_id');
    }

    protected $dates = ['draw_date'];
     public function userPackageBuys()
    {
        return $this->hasMany(Userpackagebuy::class, 'package_id');
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

}
