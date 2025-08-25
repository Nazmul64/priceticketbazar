<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class profit extends Model
{

    protected $fillable = ['user_id', 'from_user_id', 'deposit_id', 'amount', 'level'];

    protected $casts = [
        'user_id' => 'integer',
        'from_user_id' => 'integer',
        'deposit_id' => 'integer',
        'amount' => 'decimal:2',
        'level' => 'integer',
        'user_id',
        'note',
    ];


    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fromUser() {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function deposit() {
        return $this->belongsTo(Deposite::class, 'deposit_id');
    }
}
