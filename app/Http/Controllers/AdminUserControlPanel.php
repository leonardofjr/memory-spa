<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HelperMethodsController;
use App\Portfolio;
use App\User;
use App\Blog;
use Carbon\Carbon;

class AdminUserControlPanel extends Controller
{
    public function  getBlogPage() {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $blog = $user->blog;
        $data = [];

        foreach($blog as $i => $blogItem) {
            $data[$i] = [
                'id' => $blogItem->id,
                'title' => $blogItem->title,
                'author' => $user->fname,
                'created_at' => $blogItem->created_at,
            ];
        };
        return view('backend.pages.blog.index')->with('data', $data);
    }
  
    public function getPortfolioPage() {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        // Issue Resolved
        $portfolio = $user->portfolio;
        $data = [];
        foreach ($portfolio as $i => $item) {
            $data[$i] = [
                'id' => $item->id,
                'title' => $item->title,
                'author' => $user->fname,
                'created_at' => (new Carbon($item->created_at))->format('M/d/Y'),
                'type' => $item->type,
            ];
       }


       return view('backend.getPortfolioPage')->with([
            'data' => $data,
            'skill_set' => json_decode($user->skill_set),
       ]);
    }

    public function getAddPortfolioEntryPage()
    {   
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $helper = new HelperMethodsController;
        $type_dropdown = $helper->typeDrowndown();
       // Passing in array of $langauges to View
        return view('backend.addPortfolioEntry')->with([
            'type_dropdown' => $type_dropdown,
            'skill_set' => json_decode($user->skill_set),
        ]);
    }

   
    public function getEditPortfolioPage($id) {
        $helper = new HelperMethodsController();
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $type_dropdown = $helper->typeDrowndown();
        $portfolio = Portfolio::findOrFail($id);
        return view('backend.editWorkPost')->with([
            'data' => $portfolio,
            'type_dropdown' => $type_dropdown,
            'skill_set' => json_decode($user->skill_set),
            ]);
    }
    public function getUpdateBlogPostPage($id) {
        $helper = new HelperMethodsController();
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $blog = Blog::findOrFail($id);
        return view('backend.pages.blog.update')->with([
            'data' => $blog,
            ]);
    }

    public function getSettingsPage() {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('backend.settingsPage')->with([
            'data' => $user,
            'id' => $user_id
            ]);
    }
  
}
