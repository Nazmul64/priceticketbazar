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
        'new_photo',
        'status',
        'draw_date',
        'first_prize',
        'second_prize',
        'third_prize',
        'win_type',
    ];

    protected $dates = ['draw_date'];
    protected $casts = [
        'draw_date' => 'datetime',
    ];
}
