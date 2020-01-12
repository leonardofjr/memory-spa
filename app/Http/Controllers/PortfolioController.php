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

   }

   
   public function updatePortfolioEntry(PortfolioEntryRequest $request, $id) {

   
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
