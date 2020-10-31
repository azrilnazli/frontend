<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use App\Jobs\ProcessVideo;
use Illuminate\Http\Request;
use Auth;
use File;

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
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'file' => ['required', 'mimes:mp4,mov,MP4,MOV'], 
        ];
    
        $customMessages = [
            'file.required' => 'The video :attribute field is required.'
        ];
    
        $this->validate($request, $rules, $customMessages);

        //User::create($request->all());

        $video = Video::create([
            'user_id' => Auth::user()->id, 
            'title' => $request['title'],
            'description' => $request['description'],
        ]);

        if($request->hasFile('file')){

            $file =  $request['file'];
            $filename = $file->getClientOriginalName();
            $path = public_path().'/uploads/' . $video->id;
            File::makeDirectory($path, $mode = 0777, true, true); 
            File::makeDirectory($path . '/videos', $mode = 0777, true, true);
            File::makeDirectory($path . '/images', $mode = 0777, true, true);
            File::makeDirectory($path . '/logs', $mode = 0777, true, true);
            $file->move($path . '/videos', 'original.mp4');

            # dispatch job here
            //dispatch(new ProcessVideo($video->id));
            ProcessVideo::dispatch($video->id);
        }

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
        $data =  Video::find($video->id);
        return view('admin.videos.show',compact(['data']));
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
        File::deleteDirectory(public_path('uploads/'. $id));
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
