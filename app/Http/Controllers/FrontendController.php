<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Portfolio;
use App\PortfolioPhoto;
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
     * @return \Illuminate\Http\Response
     */
    public function getHomePage()
    {
        /* If user is logged in then the $user_id value will be set to the users id */
        if (Auth::user()) {
            $user_id = auth()->user()->id;
        } 
            /* Else if the user is a guest then we will set the $user_id to 1 */
        else if (Auth::guest()) {
            $user_id = 1;
        }
        $user = User::find($user_id);
        $data = $user;
        return ["guest" => $data, "user" => Auth::user()];
    }

    
    public function getPortfolioPage() {
        $helper = new HelperMethodsController;
        $data = $helper->getPortfolioData();
        $user_skill_set = $helper->getUserSkillset();
        return [
            "user_data" => $data,
            "user_skill_set" => $user_skill_set,
            ];
    } 
}

