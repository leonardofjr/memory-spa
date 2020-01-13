<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Portfolio;
use App\User;
use App\Http\Controllers\HelperMethodsController;

class FrontendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     */
    public function getHomePage()
    {
        return view('frontend.home.index');
    }


}

