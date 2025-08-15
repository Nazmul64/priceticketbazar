<?php

namespace App\Models;

use App\Http\Controllers\Backend\WaletaSetupController;
use Illuminate\Database\Eloquent\Model;

class Deposite extends Model
{
   protected $fillable=[
     "user_id","amount","payment_method","transaction_id","screenshot","status","new_screenshot",
   ];

   public function method_type()
{
    return $this->belongsTo(Waleta_setup::class,"payment_method");
}
}
