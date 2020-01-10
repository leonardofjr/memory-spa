<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserSettingsRequest;
use App\User;
use App\Skill;
use App\Set;
use Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Auth;
use App\Portfolio;
use App\PortfolioPhoto;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;

class UserSettingController extends Controller
{

    private const TEMP_DIRECTORY = 'temp/';
    private const LOGO_DIRECTORY = 'logo/';

    function getUserSettings() {
                /* If user is logged in then the $user_id value will be set to the users id */
        if (Auth::user()) {
            $user_id = auth()->user()->id;
        } 
            /* Else if the user is a guest then we will set the $user_id to 1 */
        else if (Auth::guest()) {
            $user_id = 1;
        }
        $user = User::find($user_id);
        $user->logged_in =  Auth::user();
        $portfolio = Portfolio::get()->where('user_id', $user_id);
        $portfolio_photo = PortfolioPhoto::all();
        $photos = [];
        foreach($portfolio as $i => $item) {
            $photos[$i] = $item;
            $photos[$i]->portfolio_entries = $item->portfolio_entries;
        }
        $user->portfolio = $photos;
        return $user;
    }

    function updateUserSettings(Request $request, $id)
    {
        if ($request->hasFile('profileImage')) {
            
            $this->emptyLogoDirectory();
            // Searching by Users corresponding id
            $user = User::findOrFail($id);
            
            // Getting current file name
            $current_file = $user->profileImage;
            
            // Removing file from storage
            if ($current_file !== 'logo.png') {
                Storage::disk('public')->delete($current_file);

            }
            // Storing new File using laravels file storage
            $new_file = Storage::move(UserSettingController::TEMP_DIRECTORY . 'logo.png', '/logo/logo.png' );

            // Preparing updated data to database
            $user->profile_image = 'logo.png';
            $user->bio = $request->bio;
            $user->skills_and_offer = $request->skills_and_offer;
            $user->lname = $request->lname;
            $user->fname = $request->fname;
            $user->phone = $request->phone;
            $user->twitter_url = $request->twitter_url;
            $user->facebook_url = $request->facebook_url;
            $user->linkedin_url = $request->linkedin_url;
            $user->github_url = $request->github_url;
            $user->email = $request->email;
            // Saving data to database
            $user->save();
            return response()->json([
                "redirect" => "/admin/settings",
            ]);
        }

        else {
            // Searching by his corresponding id
            $user = User::findOrFail($id);
         
            // Updating Database
            $user->bio = $request->bio;
            $user->skills_and_offer = $request->skills_and_offer;
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->phone = $request->phone;
            $user->twitter_url = $request->twitter_url;
            $user->facebook_url = $request->facebook_url;
            $user->linkedin_url = $request->linkedin_url;
            $user->github_url = $request->github_url;
            $user->email = $request->email;

            $user->save();
            return response()->json([
                "redirect" => "/admin/settings",
            ]);
        }

    }


    function uploadCroppedImage(Request $request) {
        if($request->input('image')) {

            $image_name = 'logo.png';
            $encoded_image = $request->input('image');
            $img_array = explode(';', $encoded_image);
            $img_array_2 = explode(',', $img_array[1]);
            $prepared_base_64_image = $img_array_2[1];
            
            $this->emptyTempDirectory();


            Storage::put(UserSettingController::TEMP_DIRECTORY . $image_name, base64_decode($prepared_base_64_image));

            return response()->json([
                'filename' => $image_name,
                'tempDirectory' => '/storage/' . UserSettingController::TEMP_DIRECTORY,
            ]);
        }

    }

    function emptyTempDirectory() {
        Storage::deleteDirectory(UserSettingController::TEMP_DIRECTORY);
    }
    function emptyLogoDirectory() {
        Storage::deleteDirectory(UserSettingController::LOGO_DIRECTORY);
    }
}
