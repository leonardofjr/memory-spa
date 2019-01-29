<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HelperMethodsController;
use App\Portfolio;
use App\PortfolioPhoto;
use App\Skills;
use App\UserSettings;


class AdminUserControlPanel extends Controller
{
    public function  getSkillsPage() {
        $profile_data = Skills::findOrFail(1);
        return view('backend.skillsPage')->withData($profile_data);
    }
  
    public function getWorkPage() {
       $portfolio_data = Portfolio::all();
       $portfolio_photo_data = PortfolioPhoto::all();
      $data = [];
       foreach ( $portfolio_data as $i => $item) {
           $data[$i] = [
               'id' => $item->id,
               'title' => $item->title,
               'description' => $item->description,
               'website_url' => $item->website_url,
               'technologies' => $item->technologies,
               'files' => $portfolio_photo_data->where('id', $item->id)
           ];
       }

       return view('backend.home')->withData($data);
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
        $user_settings = UserSettings::findOrFail(1);
        return view('backend.settingsPage')->withData($user_settings);
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
