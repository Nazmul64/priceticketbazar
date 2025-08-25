<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Lotter;
use App\Models\Whychooseinvestmentplan;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function frontend()
    {
        $Whychooseinvestmentplan = Whychooseinvestmentplan::all();
        $lotterys=Lotter::all();
        $aboutus=About::all();
        return view('Frontend.index',compact('lotterys','Whychooseinvestmentplan','aboutus'));
    }
    // User registration and login methods can be added here


}
