<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class profit extends Model
{

    protected $fillable = ['user_id','from_user_id','deposit_id','amount','level'];

    public function user(){ return $this->belongsTo(User::class); }
    public function fromUser(){ return $this->belongsTo(User::class,'from_user_id'); }
    public function deposit(){ return $this->belongsTo(Deposite::class); }



}
