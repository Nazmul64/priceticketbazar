<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name','email','password','phone','address','role','username','referred_by','ref_id','refer_income','generation_income','status','role','ref_code',
    ];



public function referrer() { return $this->belongsTo(User::class, 'referred_by'); }
public function referees() { return $this->hasMany(User::class, 'referred_by'); }
public function deposits() { return $this->hasMany(\App\Models\Deposite::class); }
public function profits()  { return $this->hasMany(\App\Models\Profit::class); }

public function referrals()
{
    return $this->hasMany(User::class, 'referred_by')->with('referrals');
    // nested referrals লোড হবে
}



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
