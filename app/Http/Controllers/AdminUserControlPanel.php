<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HelperMethodsController;
use App\Portfolio;
use App\PortfolioPhoto;
use App\Skill;
use App\User;
use App\UserSetting;


class AdminUserControlPanel extends Controller
{
    public function  getSkillsPage() {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        return view('backend.skillsPage')->with('data', $user->skills);
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
               'description' => $item->description,
               'website_url' => $item->website_url,
               'technologies' => $item->technologies,
               'files' => $portfolio_photos->where('id', $item->id)
           ];
       }

       return view('backend.home')->withData($data);
    }

    public function getAddPortfolioEntryPage()
    {
        $helper = new HelperMethodsController;
        $programming_languages = $helper->listOfProgrammingLanguages();
        $type_dropdown = $helper->typeDrowndown();
       // Passing in array of $langauges to View
        return view('backend.addPortfolioEntry')->with([

            'type_dropdown' => $type_dropdown,
            'programming_languages' => $programming_languages
        ]);
    }

   
    public function getEditPortfolioPage($id) {
        $helper = new HelperMethodsController();
        $programming_languages = $helper->listOfProgrammingLanguages();
        $type_dropdown = $helper->typeDrowndown();
        $portfolio_data = Portfolio::findOrFail($id);
        return view('backend.editWorkPost')->with([
            'data' => $portfolio_data,
            'type_dropdown' => $type_dropdown,
            'programming_languages' => $programming_languages,
            ]);
    }

    public function getSettingsPage() {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('backend.settingsPage')->with([
            'data' => $user->user_settings,
            'id' => $user_id
            ]);
    }

    public function getSetupSkillsPage() {
        return view('backend.setupSkillsPage')->withSkills($this->getSkillsArray());
    }

    public function getSetupPage()
    {
        if (!request()->is('setup') && url()->previous() != url('register') ) {
            return redirect()-to('register');
        }
        else {
            return view('backend.setupPage');

        }
        
    }

    public function getSkillsArray() {
        return [
            [
                "name" => "HTML5",
                "value" => "html",
            ],
            [
                "name" => "CSS3",
                "value" => "css",
            ],
            [
                "name" => "Javascript",
                "value" => "javascript",
            ],
            [
                "name" => "Bootstrap",
                "value" => "bootstrap",
            ],
            [
                "name" => "Angular",
                "value" => "angular",
            ],
            [
                "name" => "Vue.js",
                "value" => "vuejs",
            ],
            [
                "name" => "PHP",
                "value" => "php",
            ],
            [
                "name" => "Laravel",
                "value" => "laravel",
            ],
            [
                "name" => "Express.js",
                "value" => "expressjs",
            ],
            [
                "name" => "Git",
                "value" => "git",
            ],
            [
                "name" => "Windows",
                "value" => "windows",
            ],
            [
                "name" => "Mac",
                "value" => "mac",
            ],
            [
                "name" => "Linux",
                "value" => "linux",
            ],
        ];
    }

  
}
