<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserSettings;

class UserSettingController extends Controller
{
    function create(Request $request) {
        $user_settings = new UserSettings([
            'html' => $request->html,
            'css' => $request->css,
            'css' => $request->javascript,
            'javascript' => $request->javascript,
        ]);

        $user_settings->save();
    }
    function update(Request $request, $id) {
        $user_settings = UserSettings::findOrFail($id);
        $user_settings->html = $request->html;
        $user_settings->css = $request->css;
        $user_settings->save();
        return redirect('/profile');
    }
}
