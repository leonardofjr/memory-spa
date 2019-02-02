<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserSetting;
use App\Skill;

class UserSettingController extends Controller
{

    function createUserSettings(Request $request)
    {
        $user_settings = new UserSetting([
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
        $user_settings = UserSetting::findOrFail($id);
        $user_settings->phone = $request->phone;
        $user_settings->twitter_url = $request->twitter_url;
        $user_settings->facebook_url = $request->facebook_url;
        $user_settings->instagram_url = $request->instagram_url;
        $user_settings->email = $request->email;
        $user_settings->save();
        return redirect('/settings');

    }

    function createSkills(Request $request) {
        $skill = new Skill([
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
        return redirect('/settings');

    }
    function updateSkills(Request $request, $id) {
        $skill = Skill::findOrFail($id);
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
        return redirect('/skills');
    }

}
