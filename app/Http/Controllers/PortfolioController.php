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


   public function postPortfolioEntry(PortfolioEntryRequest $request) {
    $helper = new HelperMethodsController;

    if ($request->hasFile('file_1') ) {
        // Storing File into variable and storing file in the the storage public folder
        $file_1 = $request->file('file_1')->store('public');

        // Preparing data to database

        $portfolio = new Portfolio([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'type' => $request->type,
            'website_url' => $request->website_url,
            'technologies' => json_encode(explode(',' ,$request->project_technologies)),
            'description' => $request->description

        ]);
        $portfolio_photos = new PortfolioPhoto([
            'filename_1' => $request->file_1->hashName(),
        ]);
        $portfolio->save();
        $portfolio->portfolio_entries()->save($portfolio_photos);

        // Responding by sending redirect value 
        return response()->json([
            "redirect" => "/admin/portfolio",
        ]);
    }   else {
            return false;
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

      // Searching by Users corresponding id
        $portfolio = Portfolio::findOrFail($id);
        $portfolio_photos = PortfolioPhoto::findOrFail($id);
       
        // Getting current file name
        $current_file = $portfolio_photos->filename_1;
            
        // Removing file from storage
        Storage::disk('public')->delete($current_file);

        // Storing new File using laravels file storage
        $new_file = $request->file('file_1')->store('public');

        // Preparing updated data to database
        $portfolio->title = $request->title;
        $portfolio->description = $request->description;
        $portfolio->website_url = $request->website_url;
        $portfolio->type = $request->type;
        $portfolio->technologies = json_encode(explode(',' ,$request->project_technologies));

        // Saving data to database
        $portfolio->save();
        // Updating Portfolio Photo Table 
        PortfolioPhoto::where('portfolio_entry_id', $id)->update([
            'filename_1' => $request->file_1->hashName(),
        ]);

        // Responding by sending redirect value 
        return response()->json([
            "redirect" => "/admin/portfolio",
        ]);
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
       return redirect('admin/portfolio');
   }
}
