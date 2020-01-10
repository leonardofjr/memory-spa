<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Storage;
use App\PortfolioEntryTypeDropdown;

class HelperMethodsController extends Controller
{
    
    private const TEMP_DIRECTORY = 'temp/';
    private const LOGO_DIRECTORY = 'logo/';
    
    // Helper Functions

    public function array_filter_null($a) {
        $filtered = array_filter($a, 'strlen');
        $result = array_values($filtered);
        return $result;
    }

    public function typeDrowndown() {
        $portfolio_entry_type_dropdown = PortfolioEntryTypeDropdown::all();
        return $portfolio_entry_type_dropdown;
    }
    public function getUserSkillset() {
          /* If user is logged in then the $user_id value will be set to the users id */
        if (Auth::user()) {
            $user_id = auth()->user()->id;
        } 
            /* Else if the user is a guest then we will set the $user_id to 1 */
        else if (Auth::guest()) {
            $user_id = 1;
        }
        $user = User::find($user_id);

        return json_decode($user->skill_set);
    }

    public function getPortfolioData($id) {
        /* If user is logged in then the $user_id value will be set to the users id */
        $user_id = $id;

        /* We will find the user by their id */
        $user = User::find($user_id);
        $portfolio = $user->portfolio;
        $data = [];
        foreach ($portfolio as $i => $item) {
            $data[$i] = [
                'id' => $item->id,
                'title' => $item->title,
                'website_url' => $item->website_url,
                'description' => $item->description,
                'technologies' => json_decode($item->technologies),
                'files' => $portfolio_photos->where('portfolio_entry_id', $item->id)
            ];
        }

        return $data;
    } 

    public function uploadCroppedImage(Request $request) {
        if($request->input('image')) {

            $image_name = time() . '.png';
            $encoded_image = $request->input('image');
            $img_array = explode(';', $encoded_image);
            $img_array_2 = explode(',', $img_array[1]);
            $prepared_base_64_image = $img_array_2[1];
            
            $this->emptyTempDirectory();


            Storage::put(HelperMethodsController::TEMP_DIRECTORY . $image_name, base64_decode($prepared_base_64_image));

            return response()->json([
                'filename' => $image_name,
                'tempDirectory' => '/storage/' . HelperMethodsController::TEMP_DIRECTORY,
            ]);
        }

    }

    public function emptyTempDirectory() {
        Storage::deleteDirectory(HelperMethodsController::TEMP_DIRECTORY);
    }
    public function emptyLogoDirectory() {
        Storage::deleteDirectory(UserSettingController::LOGO_DIRECTORY);
    }
}
