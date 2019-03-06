<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HelperMethodsController;
use App\Portfolio;
use App\PortfolioPhoto;
use App\User;
use Carbon\Carbon;

class AdminUserControlPanel extends Controller
{
    public function  getSkillsPage() {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('backend.skillsPage')->with('data', $user);
    }
  
    public function getPortfolioPage() {
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
                'author' => $user->fname,
                'created_at' => (new Carbon($item->created_at))->format('M/d/Y'),
                'type' => $item->type,
            ];
       }


       return view('backend.getPortfolioPage')->with([
            'data' => $data,
            'skill_set' => json_decode($user->skill_set),
       ]);
    }

    public function getAddPortfolioEntryPage()
    {   
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $helper = new HelperMethodsController;
        $type_dropdown = $helper->typeDrowndown();
       // Passing in array of $langauges to View
        return view('backend.addPortfolioEntry')->with([
            'type_dropdown' => $type_dropdown,
            'skill_set' => json_decode($user->skill_set),
        ]);
    }

   
    public function getEditPortfolioPage($id) {
        $helper = new HelperMethodsController();
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $type_dropdown = $helper->typeDrowndown();
        $portfolio = Portfolio::findOrFail($id);
        $portfolio_photos = PortfolioPhoto::all();
        return view('backend.editWorkPost')->with([
            'data' => $portfolio,
            'type_dropdown' => $type_dropdown,
            'skill_set' => json_decode($user->skill_set),
            ]);
    }

    public function getSettingsPage() {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('backend.settingsPage')->with([
            'data' => $user,
            'id' => $user_id
            ]);
    }
  
}
