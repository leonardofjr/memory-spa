<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserSettings;
use App\Skills;

class UserSettingController extends Controller
{

    function createUserSettings(Request $request)
    {
        $user_settings = new UserSettings([
            'phone' => $request->phone,
            'twitter_url' => $request->twitter_url,
            'facebook_url' => $request->facebook_url,
            'instagram_url' => $request->instagram_url,
            'github_url' => $request->github_url,
            'email' => $request->email,
        ]);

        $user_settings->save();
        return redirect('/setup-skills');

    }
    function updateUserSettings(Request $request, $id)
    {
        $user_settings = UserSettings::findOrFail($id);
        $user_settings->phone = $request->phone;
        $user_settings->twitter_url = $request->twitter_url;
        $user_settings->facebook_url = $request->facebook_url;
        $user_settings->instagram_url = $request->instagram_url;
        $user_settings->email = $request->email;
        $user_settings->save();
    }

    function createSkills(Request $request) {
        $user_settings = new Skills([
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

        $user_settings->save();
    }
    function updateSkills(Request $request, $id) {
        $user_settings = Skills::findOrFail($id);
        $user_settings->html = $request->html;
        $user_settings->css = $request->css;
        $user_settings->javascript = $request->javascript;
        $user_settings->php = $request->php;
        $user_settings->bootstrap = $request->bootstrap;
        $user_settings->angular = $request->angular;
        $user_settings->vuejs = $request->vuejs;
        $user_settings->laravel = $request->laravel;
        $user_settings->expressjs = $request->expressjs;
        $user_settings->git = $request->git;
        $user_settings->windows = $request->windows;
        $user_settings->mac = $request->mac;
        $user_settings->linux = $request->linux;
        $user_settings->save();
        return redirect('/profile');
    }

}
