<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserSettingsRequest;
use App\UserSetting;
use App\Skill;
use Illuminate\Support\Facades\Storage;

class UserSettingController extends Controller
{

    function createUserSettings(UserSettingsRequest $request)
    {
        if ($request->hasFile('profile_image')) {
            // Storing new File using laravels file storage
            $file = $request->file('profile_image')->store('public');

            // Preparing data
            $user_settings = new UserSetting([
                'user_id' => $request->user_id,
                'bio' => $request->bio,
                'phone' => $request->phone,
                'twitter_url' => $request->twitter_url,
                'facebook_url' => $request->facebook_url,
                'instagram_url' => $request->instagram_url,
                'github_url' => $request->github_url,
                'email' => $request->email,
                'profile_image' => $request->profile_image->hashName(),
            ]);

            // Storing data to database
            $user_settings->save();

           // Responding by sending redirect value 
            return response()->json([
                "redirect" => "/admin/setup-skills",
            ]);
        } else {
            // Preparing data
            $user_settings = new UserSetting([
                'user_id' => $request->user_id,
                'bio' => $request->bio,
                'phone' => $request->phone,
                'twitter_url' => $request->twitter_url,
                'facebook_url' => $request->facebook_url,
                'instagram_url' => $request->instagram_url,
                'github_url' => $request->github_url,
                'email' => $request->email,
            ]);
            // Storing data to database
            $user_settings->save();

           // Responding by sending redirect value 
            return response()->json([
                "redirect" => "/admin/setup-skills",
            ]);

        }
    }
    function updateUserSettings(UserSettingsRequest $request, $id)
    {
        if ($request->hasFile('profile_image')) {
                        
            // Searching by Users corresponding id
            $user_settings = UserSetting::findOrFail($id);
            
            // Getting current file name
            $current_file = $user_settings->profile_image;
            
            // Removing file from storage
            Storage::disk('public')->delete($current_file);

            // Storing new File using laravels file storage
            $new_file = $request->file('profile_image')->store('public');

            // Preparing updated data to database
            $user_settings->profile_image = $request->profile_image->hashName();
            $user_settings->bio = $request->bio;
            $user_settings->phone = $request->phone;
            $user_settings->twitter_url = $request->twitter_url;
            $user_settings->facebook_url = $request->facebook_url;
            $user_settings->instagram_url = $request->instagram_url;
            $user_settings->github_url = $request->github_url;
            $user_settings->email = $request->email;
            // Saving data to database
            $user_settings->save();
            return response()->json([
                "redirect" => "/admin/settings",
            ]);
        }

        else {
            // Searching by his corresponding id
            $user_settings = UserSetting::findOrFail($id);
         
            // Updating Database
            $user_settings->bio = $request->bio;
            $user_settings->phone = $request->phone;
            $user_settings->twitter_url = $request->twitter_url;
            $user_settings->facebook_url = $request->facebook_url;
            $user_settings->instagram_url = $request->instagram_url;
            $user_settings->github_url = $request->github_url;
            $user_settings->email = $request->email;

            $user_settings->save();
            return response()->json([
                "redirect" => "/admin/settings",
            ]);
        }

    }

    function createSkills(Request $request) {
        $skill = new Skill([
            'user_id' => $request->user_id,
            'skills-and-offer' => $request->skills_and_offer,
            'html' => $request->html,
            'css' => $request->css,
            'javascript' => $request->javascript,
            'php' => $request->php,
            'bootstrap' => $request->bootstrap,
            'angular' => $request->angular,
            'vuejs' => $request->vuejs,
            'laravel' => $request->laravel,
            'expressjs' => $request->expressjs,
            'git' => $request->git,
            'windows' => $request->windows,
            'mac' => $request->mac,
            'linux' => $request->linux,
        ]);

        $skill->save();
        return redirect('/admin/settings');

    }
    function updateSkills(Request $request, $id) {
        $skill = Skill::findOrFail($id);
        $skill->skills_and_offer = $request->skills_and_offer;
        $skill->html = $request->html;
        $skill->css = $request->css;
        $skill->javascript = $request->javascript;
        $skill->php = $request->php;
        $skill->bootstrap = $request->bootstrap;
        $skill->angular = $request->angular;
        $skill->vuejs = $request->vuejs;
        $skill->laravel = $request->laravel;
        $skill->expressjs = $request->expressjs;
        $skill->git = $request->git;
        $skill->windows = $request->windows;
        $skill->mac = $request->mac;
        $skill->linux = $request->linux;
        $skill->save();
        return redirect('/admin/skills');
    }

}
