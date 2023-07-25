<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
       // $user = Auth::user();
       // echo user()->name 
      // print_r($user);
      $posts = Post::find(1);
       return view('home',['posts'=>$posts]);
    }

    public function update(Post $post){
        if (Auth::user()->role == 'admin'){
        $inputs=request()->validate([
           'image' => 'image|mimes:jpg,png,jpeg|max:2048',
            'description' =>'required'
            ]);
            if(request(key:'image')){
                $inputs['image'] = request(key:'image')->store('images');
                $post->image= $inputs['image'];
            }
           
            $post->description= $inputs['description'];
            $post->save();
            Session::flash('post-update-message', 'Post updated');
            return redirect()->route('home');
        }
    }
}
