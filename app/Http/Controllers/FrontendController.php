<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Deposite;
use App\Models\Lotter;
use App\Models\Privacypolicy;
use App\Models\Whychooseinvestmentplan;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function frontend()
    {
        $Whychooseinvestmentplan = Whychooseinvestmentplan::all();
        $lotterys=Lotter::all();
        $aboutus=About::all();
        $deposite =Deposite::where('status','approved')->get();
        // $priavacypolicy =Privacypolicy::all();
        return view('Frontend.index',compact('lotterys','Whychooseinvestmentplan','aboutus','deposite'));
    }
    public function privacy()
    {
        $priavacypolicy =Privacypolicy::all();
        return view('Frontend.pages.privacy',compact('priavacypolicy'));
    }
    // User registration and login methods can be added here


}
