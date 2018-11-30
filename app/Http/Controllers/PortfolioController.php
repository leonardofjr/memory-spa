<?php

namespace App\Http\Controllers;

// Request Validation
use App\Http\Requests\PortfolioEntryRequest;
use Illuminate\Http\Request;


// Models
use App\Portfolio;
use App\PortfolioPhoto;

// Helpers
use App\Http\Controllers\HelperMethodsController;
use App\Http\Controllers\FileHandling;

// Storage / DB
use DB;
use Storage;


class PortfolioController extends Controller
{

    public function getAddPortfolioEntry() {
        $helper = new HelperMethodsController;
        $programming_languages = $helper->listOfProgrammingLanguages();
        $type_dropdown = $helper->typeDrowndown();
       // Passing in array of $langauges to View
       return view('backend.addPortfolioEntry')->with([
           
           'type_dropdown' =>$type_dropdown,
           'programming_languages' => $programming_languages
           ]);
   }

   
   public function postPortfolioEntry(PortfolioEntryRequest $request) {
    $helper = new HelperMethodsController;

    $file_1 = $request->file_1;
   $file_2 = $request->file_2;
   $file_3 = $request->file_3;
   
   if ($request->hasFile($file_1) || $request->hasFile($file_2) || $request->hasFile($file_3) ) {
   
       
       $portfolio_photos = new PortfolioPhoto([
           'filename_1' => time() . '_' .  $file_1->getClientOriginalName(),
           'filename_2' => time() . '_' .  $file_2->getClientOriginalName(),
           'filename_3' => time() . '_' .  $file_3->getClientOriginalName(),
       ]);

       Storage::disk('public')->put($portfolio_photos['filename_1'], file_get_contents($file_1));

       Storage::disk('public')->put($portfolio_photos['filename_2'], file_get_contents($file_2));

       Storage::disk('public')->put($portfolio_photos['filename_3'], file_get_contents($file_3));

       $portfolio->portfolio_entries()->save($portfolio_photos);
  
   }

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
           'technologies' => json_encode($helper->array_filter_null($technologies)),
           'description' => $request->description

       ]);

       $portfolio->save();

      return response()->json($portfolio);
   }

   
   public function updatePortfolioEntry(PortfolioEntryRequest $request, $id) {
        $helper = new HelperMethodsController;
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
           'technologies' => json_encode($helper->array_filter_null($technologies)),
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
}
