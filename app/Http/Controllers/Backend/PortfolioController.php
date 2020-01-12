<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Portfolio;
use App\Http\Controllers\HelperMethodsController;
use Storage;
use Auth;
use Carbon\Carbon;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
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


       return view('backend.pages.portfolio.index')->with([
            'data' => $data,
            'skill_set' => json_decode($user->skill_set),
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $helper = new HelperMethodsController;
        $type_dropdown = $helper->typeDrowndown();
       // Passing in array of $langauges to View
        return view('backend.pages.portfolio.create')->with([
            'type_dropdown' => $type_dropdown,
            'skill_set' => json_decode($user->skill_set),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('uploadedImageFile') ) {
            // Storing File into variable and storing file in the the storage public folder
 
            // Getting current file name
            $temp_filename = explode('/', Storage::allFiles('temp/')[0])[1];
            $temp_file_location = Storage::allFiles('temp/')[0];

            // Storing new File using laravels file storage
            $new_file = Storage::move($temp_file_location, 'imgs/' . $temp_filename );

            // Preparing updated data to database
            $portfolio = new Portfolio();

            $portfolio->user_id = Auth::id();
            $portfolio->title = $request->title;
            $portfolio->type = $request->type;
            $portfolio->website_url = $request->website_url;
            $portfolio->technologies = json_encode($request->technologies);
            $portfolio->description = $request->description;
            $portfolio->image = $temp_filename;

            $portfolio->save();

            // Responding by sending redirect value 
            return redirect('/admin/portfolio');

            
        }   else {
            return response()->json([
                $request
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $helper = new HelperMethodsController();
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $type_dropdown = $helper->typeDrowndown();
        $portfolio = Portfolio::findOrFail($id);
        return view('backend.pages.portfolio.edit')->with([
            'data' => $portfolio,
            'type_dropdown' => $type_dropdown,
            'skill_set' => json_decode($user->skill_set),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('uploadedImageFile')) {
            // Searching by Users corresponding id
            $portfolio = Portfolio::findOrFail($id);
       
        
            // Getting current file name
            $current_file = $portfolio->image;
                
            // Removing file from storage
            Storage::delete('imgs/' . $current_file);

            // Storing new File using laravels file storage            
            $temp_filename = time() . '.png';
            $temp_file_location = Storage::allFiles('temp/')[0];

            // Storing new File using laravels file storage
            $new_file = Storage::move($temp_file_location, 'imgs/' . $temp_filename );

            // Preparing updated data to database
            $portfolio->title = $request->title;
            $portfolio->description = $request->description;
            $portfolio->image = $temp_filename;
            $portfolio->website_url = $request->website_url;
            $portfolio->type = $request->type;
            $portfolio->technologies = json_encode($request->technologies);

            // Saving data to database
            $portfolio->save();
            // Updating Portfolio Photo Table 

            // Responding by sending redirect value 
            return redirect('/admin/portfolio');

        }
        else {
            // Searching by Users corresponding id
            $portfolio = Portfolio::findOrFail($id);
             // Preparing updated data to database
            $portfolio->title = $request->title;
            $portfolio->description = $request->description;
            $portfolio->website_url = $request->website_url;
            $portfolio->type = $request->type;
            $portfolio->technologies = json_encode($request->technologies);
            // Saving data to database
            $portfolio->save();
            // Responding by sending redirect value 
            return redirect('/admin/portfolio');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
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
