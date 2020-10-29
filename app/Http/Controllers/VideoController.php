<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Auth;

class VideoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Video Listing
        $data = Video::orderBy('id','desc')->paginate(10)->setPath('videos');
        return view('admin.videos.index',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // display create form
        return view('admin.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request['title']);
        $request->validate([
           
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],

        ]);

        //User::create($request->all());

        Video::create([
            'user_id' => Auth::user()->id, 
            'title' => $request['title'],
            'description' => $request['description'],
        ]);
        return redirect('videos')->with('success','Video Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    public function edit($id)
    {
       $data = Video::find($id);
       return view('admin.videos.edit',compact(['data']));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
        ]);
      
        $data['title'] = $request->input('title');
        $data['description'] = $request->input('description');

        Video::where('id',$id)->update( $data);
        return redirect('videos')->with('success','Update Successfully');
        
    }

    public function destroy($id)
    {
        Video::where('id',$id)->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        // Starts with 'foo', ends with anything
        //$results = Post::where('title', 'like', "{$keyword}%")->get()
        
        $data = Video::where([['title', 'like', "{$query}%"]])
        ->paginate(10)->setPath('videos');
        
        return view('admin.videos.index',compact(['data']));
    }
}
