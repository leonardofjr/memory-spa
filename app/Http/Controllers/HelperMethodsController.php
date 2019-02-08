<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\PortfolioPhoto;

class HelperMethodsController extends Controller
{
    
    // Helper Functions

    public function array_filter_null($a) {
        $filtered = array_filter($a, 'strlen');
        $result = array_values($filtered);
        return $result;
    }

    public function typeDrowndown() {
        return array('Website', 'App', 'Game');
    }

    public function listOfProgrammingLanguages() {
        return array(
            'HTML5',
            'CSS3',
            'Javascript',
            'PHP',
            'MySql',
            'Angular',
            'Laravel',
        );
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
}
