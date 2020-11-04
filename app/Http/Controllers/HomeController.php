<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Video;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // list all latest videos limit by 24
        $row[1] =  Video::skip(0)->take(6)->get();
        $row[2] =  Video::skip(6)->take(6)->get();

        return view('home')->with(compact('row'));
    }
}
