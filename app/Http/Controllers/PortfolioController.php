<?php

namespace App\Http\Controllers;

// Request Validation
use App\Http\Requests\PortfolioEntryRequest;
use Illuminate\Http\Request;


// Models
use App\Portfolio;
use App\PortfolioPhoto;
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
            $temp_file = Storage::allFiles('temp/')[0];

            // Storing new File using laravels file storage
            $new_file = Storage::move($temp_file, '/imgs/image1.png' );

            // Preparing updated data to database
            $portfolio = new Portfolio();

            $portfolio->user_id = Auth::id();
            $portfolio->title = $request->title;
            $portfolio->type = $request->type;
            $portfolio->website_url = $request->website_url;
            $portfolio->technologies = json_encode($request->technologies);
            $portfolio->description = $request->description;
            $portfolio->image = 'image1.png';

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


        if ($request->hasFile('file_1')) {
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
            $portfolio->technologies = json_encode($request->technologies);

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
            return response()->json([
                "redirect" => "/admin/portfolio",
            ]);
        }
   }
   
   public function deletePortfolioEntry(Request $request, $id) {
        // Getting Selection By ID
        $portfolio = Portfolio::findOrFail($id);
        // Storing Filename in variable
        $filename = $portfolio->portfolio_entries->filename_1;
        // Deleteing File
        Storage::delete('public/' . $filename);
        
       $portfolio->portfolio_entries()->delete();
       $portfolio->delete();
       return redirect('admin/portfolio');
   }
}
