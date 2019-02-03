<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\PortfolioPhoto;
use App\User;

class HomeController extends Controller
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
        $portfolio = $this->getPortfolioData();
        return view('home')->with('data', $portfolio);
    }

    
    public function portfolio() {

        $data = $this->getPortfolioData();

            return response($data);
        } 
    
    public function getPortfolioData() {
            $user_id = auth()->user()->id;
            $user = User::find($user_id);

            // Issue Resolved
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


        public function getPortfolioEntryById($id) {
            /*
            // Issue Resolved
           $portfolio = Portfolio::all();
           $portfolio_photos = PortfolioPhoto::all();
            $data = [];
           foreach ($portfolio as $i => $item) {
               $data[$i] = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'description' => $item->description,
                    'technologies' => $item->technologies,
                    'files' => $portfolio_photos->where('portfolio_entry_id', $item->id)
               ];
           }

        
      */
            $data = Portfolio::findOrFail($id);   
            return response($data);
        } 

    }

