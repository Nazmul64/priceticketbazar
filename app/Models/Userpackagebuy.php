<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Userpackagebuy extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'price',
        'status',
        'purchased_at',
        'ticket_number',
    ];

    protected $casts = [
        'purchased_at' => 'datetime',
    ];

    /**
     * Boot method for model events
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->ticket_number)) {
                // generate unique ticket number
                do {
                    $candidate = 'L-' . now()->format('Ymd') . '-' . Str::upper(Str::random(8));
                } while (self::where('ticket_number', $candidate)->exists());

                $model->ticket_number = $candidate;
            }
        });
    }

    /**
     * User who bought this package
     */


    /**
     * Lottery package
     */


    /**
     * Lottery results of this package buy
     */


    /**
     * All package buys of the same package (optional helper)
     */
    public function userPackageBuys()
    {
        return $this->hasMany(self::class, 'package_id');
    }
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

// Convenience method: Check if this buy has already won
public function hasWon()
{
    return $this->results()->exists();
}
 // Relation: User who bought this package

}
