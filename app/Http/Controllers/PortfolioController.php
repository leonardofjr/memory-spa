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
   
    if ($request->hasFile('file_1') ) {
        // Storing File into variable and storing file in the the storage public folder
        $file_1 = $request->file('file_1')->store('public');

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
            'website_url' => $request->website_url,
            'technologies' => json_encode($helper->array_filter_null($technologies)),
            'description' => $request->description

        ]);
        $portfolio_photos = new PortfolioPhoto([
            'filename_1' => basename($file_1),
        ]);
        $portfolio->save();
        $portfolio->portfolio_entries()->save($portfolio_photos);
        return redirect('/home');
    }   else {
            response('fail');
    }
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
           'website_url' => $request->website_url,
           'type' => $request->input('type'),
           'technologies' => json_encode($helper->array_filter_null($technologies)),
       ];

       DB::table('portfolio')
           ->where('id', $id)
           ->update($data);
       return response()->json($data);
   }
   
   public function deletePortfolioEntry(Request $request, $id) {
        // Getting Selection By ID
        $portfolio = Portfolio::where('id', $id)->get();
        // Storing Filename in variable
        $filename = $portfolio[0]->basename;
        // Deleteing File
        Storage::delete('public/' . $filename);
        
       $portfolio = Portfolio::findOrFail($id);

       $portfolio->portfolio_entries()->delete();
       $portfolio->delete();
       return redirect('/home');
   }
}
