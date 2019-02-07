<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Portfolio;
use App\PortfolioPhoto;
use App\User;

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
    public function index()
    {
        return view('home');
    }

    
    public function portfolio() {

        $data = $this->getPortfolioData();

            return response($data);
    } 
    
    public function getPortfolioData() {
            /* If user is logged in then the $user_id value will be set to the users id */
            if (Auth::user()) {
                $user_id = auth()->user()->id;
            } 
            /* Else if the user is a guest then we will set the $user_id to 1 */
            else if (Auth::guest()) {
                $user_id = 1;
            }

            /* We will find the user by their id */
            $user = User::find($user_id);

            $portfolio = $user->portfolio;
            $portfolio_photos = PortfolioPhoto::all();
            $data = [];
           foreach ($portfolio as $i => $item) {
               $data[$i] = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'website_url' => $item->website_url,
                    'description' => $item->description,
                    'technologies' => $item->technologies,
                    'files' => $portfolio_photos->where('portfolio_entry_id', $item->id)
               ];
           }
         
            return $data;
        } 

        public function getContactPage() {
            /* If user is logged in then the $user_id value will be set to the users id */
            if (Auth::user()) {
                $user_id = auth()->user()->id;
            } 
                /* Else if the user is a guest then we will set the $user_id to 1 */
            else if (Auth::guest()) {
                $user_id = 1;
            }
             $user = User::find($user_id);
             $data = $user->user_settings;
            return $data;
        }
        public function getAboutPage() {
            /* If user is logged in then the $user_id value will be set to the users id */
            if (Auth::user()) {
                $user_id = auth()->user()->id;
            } 
                /* Else if the user is a guest then we will set the $user_id to 1 */
            else if (Auth::guest()) {
                $user_id = 1;
            }
             $user = User::find($user_id);
             $data = $user->user_settings;
            return $data;
        }
        public function getSkillsPage() {
            /* If user is logged in then the $user_id value will be set to the users id */
            if (Auth::user()) {
                $user_id = auth()->user()->id;
            } 
                /* Else if the user is a guest then we will set the $user_id to 1 */
            else if (Auth::guest()) {
                $user_id = 1;
            }
             $user = User::find($user_id);
             $data = $user->user_settings;
            return $data;
        }

        public function getPortfolioEntryById($id) {
            $data = Portfolio::findOrFail($id);   
            return response($data);
        } 

    }

