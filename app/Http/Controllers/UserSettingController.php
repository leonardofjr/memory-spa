<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserSettingsRequest;
use App\User;
use App\Skill;
use Illuminate\Support\Facades\Storage;

class UserSettingController extends Controller
{


    function updateUserSettings(Request $request, $id)
    {
        if ($request->hasFile('profile_image')) {
                        
            // Searching by Users corresponding id
            $user = User::findOrFail($id);
            
            // Getting current file name
            $current_file = $user->profile_image;
            
            // Removing file from storage
            if ($current_file !== 'logo.png') {
                Storage::disk('public')->delete($current_file);

            }
            // Storing new File using laravels file storage
            $new_file = $request->file('profile_image')->store('public');

            // Preparing updated data to database
            $user->profile_image = $request->profile_image->hashName();
            $user->bio = $request->bio;
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


    function updateSkills(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->skills_and_offer = $request->skills_and_offer;
        $skill_set = [];
        // If skill_name is not null 
        if ($request->skill_name) {
            foreach($request->skill_name as $i => $item) {
                $skill_set[$i] = [
                    'name' => $item,
                    'website' => $request->skill_website[$i],
                ];
            }
        }

        $user->skill_set = json_encode($skill_set);
        $user->save();
        return redirect('/admin/skills');
    }

}
