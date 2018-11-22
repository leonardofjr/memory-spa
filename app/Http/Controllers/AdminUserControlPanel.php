<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\PortfolioPhoto;
use App\Http\Requests\PortfolioEntryRequest;
use App\Http\Controllers\Controller;
use Storage;
use DB;
use App\Http\Controllers\FileHandling;

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
               'technologies' => $item->technologies,
               'files' => $portfolio_photo_data->where('id', $item->id)
           ];
       }

       return view('backend.home')->withData($data);
    }
  
    public function getEditWorkPage($id) {
        $programming_languages = $this->listOfProgrammingLanguages();
        $type_dropdown = $this->typeDrowndown();
        $portfolio_data = Portfolio::all();
        return view('backend.editWorkPost')->with([
            'id' => $id,
            'data' => $portfolio_data[0],
            'type_dropdown' =>$type_dropdown,
            'programming_languages' => $programming_languages
        ]);
    }

    public function getAddPortfolioEntry() {
         $programming_languages = $this->listOfProgrammingLanguages();
         $type_dropdown = $this->typeDrowndown();
        // Passing in array of $langauges to View
        return view('backend.addPortfolioEntry')->with([
            'type_dropdown' =>$type_dropdown,
            'programming_languages' => $programming_languages
            ]);
    }

    
    public function postPortfolioEntry(PortfolioEntryRequest $request) {
     $file_1 = $request->file('image_1');
     $file_2 = $request->file('image_2');
     $file_3 = $request->file('image_3');
     $destination = '/assets/uploads/';

     $technologies = [
             $request->input('html5'),
                $request->input('css3'),
                $request->input('javascript'),
                $request->input('php'),
                $request->input('mysql'),
                $request->input('angular'),
                $request->input('laravel'),
        ];

        $portfolio = new Portfolio([
            'title' => $request->title,
            'type' => $request->type,
            'technologies' => json_encode($this->array_filter_null($technologies)),
            'description' => $request->description

        ]);

       $portfolio_photos = new PortfolioPhoto([
                'filename_1' => time() . '_' .  $file_1->getClientOriginalName(),
                'filename_2' => time() . '_' .  $file_2->getClientOriginalName(),
                'filename_3' => time() . '_' .  $file_3->getClientOriginalName(),
        ]);
   
       Storage::disk('public')->put($portfolio_photos['filename_1'], file_get_contents($file_1));
   
       Storage::disk('public')->put($portfolio_photos['filename_2'], file_get_contents($file_2));
   
       Storage::disk('public')->put($portfolio_photos['filename_3'], file_get_contents($file_3));
   
       $portfolio->save();
       $portfolio->portfolio_entries()->save($portfolio_photos);
       return response()->json($portfolio);
    }

    
    public function updatePortfolioEntry(PortfolioEntryRequest $request, $id) {
         $technologies = [
            $request->input('html5'),
            $request->input('css3'),
            $request->input('javascript'),
            $request->input('php'),
            $request->input('mysql'),
            $request->input('angular'),
            $request->input('laravel'),
        ];

        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'technologies' => json_encode($this->array_filter_null($technologies)),
        ];

        DB::table('portfolio')
            ->where('id', $id)
            ->update($data);
        return response()->json($data);
    }
    
    public function deletePortfolioEntry(Request $request, $id) {
        DB::table('portfolio')
            ->where('id', $id)
            ->delete();
        return response()->json();
    }


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
  
}
