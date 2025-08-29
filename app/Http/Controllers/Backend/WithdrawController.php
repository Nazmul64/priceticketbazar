<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Deposite;
use App\Models\Waleta_setup;
use App\Models\WithdrawCommission;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
public function withdraw()
{

    $waleta_setups = Waleta_setup::all();
    $withdraw_commission = WithdrawCommission::first();
    $deposite_amount=Deposite::where('user_id', auth()->id())->sum('amount');

    return view('userdashboard.Withdraw.index', compact('waleta_setups', 'withdraw_commission','deposite_amount'));
}

}
