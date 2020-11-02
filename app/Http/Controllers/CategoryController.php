<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }    

    public function index()
    {

        $data = Category::orderBy('id','desc')->paginate(10)->setPath('categories');
        return view('admin.categories.index',compact(['data']));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        // Starts with 'foo', ends with anything
        //$results = Post::where('title', 'like', "{$keyword}%")->get()
        
        $data = Category::where([['name', 'like', "{$query}%"]])
        ->paginate(10)->setPath('categories');
        
        return view('admin.categories.index',compact(['data']));
    }

    private function getRoles()
    {
        $result = DB::select("SHOW COLUMNS FROM `categories` LIKE 'role';");
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $result[0]->Type, $enum_array );
        return $enum_fields = $enum_array[1];
    }

    public function create()
    {

        return view('admin.categories.create')->with('roles', $this->getRoles() );
    }

    public function store(Request $request)
    {
        //dd($request['role']);
        $request->validate([
            'role' => ['in:admin,manager,Category'], 
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:categories'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
           ]);

        //Category::create($request->all());

        Category::create([
            'role' => $request['role'],
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect('categories')->with('success','Create Successfully');
    }

    public function show($id)
    {
       $data =  Category::find($id);
       return view('admin.categories.show',compact(['data']));
    }

    public function edit($id)
    {
       $data = Category::find($id);
       $roles = $this->getRoles();
       return view('admin.categories.edit',compact(['data','roles']));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
         'role' => ['in:admin,manager,Category'], 
         'name'     => 'required',
         'email'    => 'required|email',
        ]);

        if( !empty( $request->input('password') ))
        {
            $data['password'] = Hash::make($request->input('password'));
        }
        
        $data['role'] = $request->input('role');
        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');

        Category::where('id',$id)->update( $data);
        return redirect('categories')->with('success','Update Successfully');
        
    }

    public function destroy($id)
    {
        Category::where('id',$id)->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }
}
