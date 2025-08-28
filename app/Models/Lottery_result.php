<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lottery_result extends Model
{
      protected $fillable = [
        'user_package_buy_id',
        'win_status',
        'win_amount',
        'draw_date'
    ];

    protected $casts = [
        'draw_date' => 'datetime',
    ];

    public function userPackageBuy()
    {
        return $this->belongsTo(Userpackagebuy::class, 'user_package_buy_id');
    }
}
