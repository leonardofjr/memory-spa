<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\PortfolioPhoto;

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
        return view('home');
    }

    
    public function portfolio() {
            
            // Issue Resolved
           $portfolio = Portfolio::all();
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
         
            return response($data);
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

