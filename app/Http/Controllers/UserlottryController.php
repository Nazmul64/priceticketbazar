<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lotter;
use App\Models\Waleta_setup;
use Illuminate\Http\Request;

class UserlottryController extends Controller
{
  public function userlotter(){
     $walate = Waleta_setup::select('accountnumber','bankname')->get();
     $lotteries =Lotter::all();
    return view("userdashboard.lottery.usersowlattery",compact("lotteries",'walate'));
  }
}
