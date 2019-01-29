<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HelperMethodsController;
use App\Portfolio;
use App\PortfolioPhoto;

class AdminUserControlPanel extends Controller
{
    public function getProfilePage() {
        return view('backend.profile');
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



  
}
