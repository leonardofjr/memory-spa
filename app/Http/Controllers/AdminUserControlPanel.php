<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HelperMethodsController;
use App\Portfolio;
use App\PortfolioPhoto;
use App\UserSettings;

class AdminUserControlPanel extends Controller
{
    public function getProfilePage() {
        $profile_data = UserSettings::findOrFail(1);
        return view('backend.profile')->withData($profile_data);
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

    public function getStartPage() {
        return view('backend.startPage')->withSkills($this->getSkillsArray());
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
                "value" => "Bootstrap",
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
