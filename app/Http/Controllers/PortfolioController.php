<?php

namespace App\Http\Controllers;

// Request Validation
use App\Http\Requests\PortfolioEntryRequest;
use Illuminate\Http\Request;


// Models
use App\Portfolio;
use Auth;

// Helpers
use App\Http\Controllers\HelperMethodsController;
use App\Http\Controllers\FileHandling;

// Storage / DB
use DB;
use Storage;


class PortfolioController extends Controller
{
    
    public function getPortfolioEntries() {
        $helper = new HelperMethodsController;
        $data = $helper->getPortfolioData();
        $user_skill_set = $helper->getUserSkillset();
        return [
            "user_data" => $data,
            "user_skill_set" => $user_skill_set,
            ];
    } 
    public function getPortfolioEntriesById($id) {
        $helper = new HelperMethodsController;
        $data = $helper->getPortfolioData($id);
        $user_skill_set = $helper->getUserSkillset();
        return [
            "user_data" => $data,
            "user_skill_set" => $user_skill_set,
            ];
    } 

   public function postPortfolioEntry(PortfolioEntryRequest $request) {
        if ($request->hasFile('uploadedImageFile') ) {
            // Storing File into variable and storing file in the the storage public folder
 
            // Getting current file name
            $temp_filename = explode('/', Storage::allFiles('temp/')[0])[1];
            $temp_file_location = Storage::allFiles('temp/')[0];

            // Storing new File using laravels file storage
            $new_file = Storage::move($temp_file_location, 'imgs/' . $temp_filename );

            // Preparing updated data to database
            $portfolio = new Portfolio();

            $portfolio->user_id = Auth::id();
            $portfolio->title = $request->title;
            $portfolio->type = $request->type;
            $portfolio->website_url = $request->website_url;
            $portfolio->technologies = json_encode($request->technologies);
            $portfolio->description = $request->description;
            $portfolio->image = $temp_filename;

            $portfolio->save();

            // Responding by sending redirect value 
            return redirect('/admin/portfolio');

            
        }   else {
            return response()->json([
                $request
            ]);
        }
   }

   
   public function updatePortfolioEntry(PortfolioEntryRequest $request, $id) {

        if ($request->hasFile('uploadedImageFile')) {
            // Searching by Users corresponding id
            $portfolio = Portfolio::findOrFail($id);
       
        
            // Getting current file name
            $current_file = $portfolio->image;
                
            // Removing file from storage
            Storage::delete('imgs/' . $current_file);

            // Storing new File using laravels file storage            
            $temp_filename = time() . '.png';
            $temp_file_location = Storage::allFiles('temp/')[0];

            // Storing new File using laravels file storage
            $new_file = Storage::move($temp_file_location, 'imgs/' . $temp_filename );

            // Preparing updated data to database
            $portfolio->title = $request->title;
            $portfolio->description = $request->description;
            $portfolio->image = $temp_filename;
            $portfolio->website_url = $request->website_url;
            $portfolio->type = $request->type;
            $portfolio->technologies = json_encode($request->technologies);

            // Saving data to database
            $portfolio->save();
            // Updating Portfolio Photo Table 

            // Responding by sending redirect value 
            return redirect('/admin/portfolio');

        }
        else {
            // Searching by Users corresponding id
            $portfolio = Portfolio::findOrFail($id);
             // Preparing updated data to database
            $portfolio->title = $request->title;
            $portfolio->description = $request->description;
            $portfolio->website_url = $request->website_url;
            $portfolio->type = $request->type;
            $portfolio->technologies = json_encode($request->technologies);
            // Saving data to database
            $portfolio->save();
            // Responding by sending redirect value 
            return redirect('/admin/portfolio');

        }
   }
   
   public function deletePortfolioEntry(Request $request, $id) {
        // Getting Selection By ID
        $portfolio = Portfolio::findOrFail($id);
        // Storing Filename in variable
        $filename = $portfolio->image;
        // Deleteing File
        Storage::delete('imgs/' . $filename);
        
       $portfolio->delete();
       return redirect('admin/portfolio');
   }
}
