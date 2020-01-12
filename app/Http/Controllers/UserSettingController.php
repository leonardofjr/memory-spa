<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserSettingsRequest;
use App\User;
use Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Auth;
use App\Portfolio;
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
        $user->logged_in =  (Auth::user() ? true : false);
        $portfolio = Portfolio::get()->where('user_id', $user_id);
        $photos = [];
        foreach($portfolio as $i => $item) {
            $photos[$i] = $item;
            $photos[$i]->portfolio_entries = $item->portfolio_entries;
        }
        $user->portfolio = $photos;
        return response()->json($user);
    }

    function updateUserSettings(Request $request, $id)
    {
        if ($request->hasFile('uploadedImageFile')) {

            $this->emptyLogoDirectory();
            // Searching by Users corresponding id
            $user = User::findOrFail($id);
            
            // Getting current file name
            $current_file = $user->uploadedImageFile;
            
            // Removing file from storage
            if ($current_file !== 'logo.png') {
                Storage::disk('public')->delete($current_file);

            }

            // Getting current file name
            $temp_file = Storage::allFiles('temp/')[0];

            // Storing new File using laravels file storage
            $new_file = Storage::move($temp_file, '/logo/logo.png' );

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
            return redirect('/admin/settings');
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
            return redirect('/admin/settings');

        }

    }


    function emptyTempDirectory() {
        Storage::deleteDirectory(UserSettingController::TEMP_DIRECTORY);
    }
    function emptyLogoDirectory() {
        Storage::deleteDirectory(UserSettingController::LOGO_DIRECTORY);
    }
}
