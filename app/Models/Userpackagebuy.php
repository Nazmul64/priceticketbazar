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

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function package() {
        return $this->belongsTo(Lotter::class, 'package_id');
    }


  protected $casts = [
    'purchased_at' => 'datetime',
];

}
