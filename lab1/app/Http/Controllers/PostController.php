<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\DataBase;

class PostController extends Controller
{

    public  static $posts = [
        ['id' => 1, 'title' => 'Laravel', 'post_creator' => 'Ahmed', 'created_at' => '2022-04-16 10:37:00','description'=>"laravel course"],
        ['id' => 2, 'title' => 'PHP', 'post_creator' => 'Mohamed', 'created_at' => '2022-04-16 10:37:00','description'=>"PHP course"],
        ['id' => 3, 'title' => 'Javascript', 'post_creator' => 'Ali', 'created_at' => '2022-04-16 10:37:00','description'=>"Javascript course"],
    ];
    public static $num_posts=3;
    public function index()
    {
       
        
        // dd($posts); for debugging
        return view('posts.index',[
            'posts' => self::$posts,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {   
        $request_out=$request->all();
        self::$num_posts =(self::$num_posts) +1;
        $newpost=['id' => (self::$num_posts), 'title' => $request_out['title'], 'post_creator' => $request_out['creator'], 'created_at' => '2022-04-16 10:37:00','description'=>$request_out['description']];
        array_push( self::$posts,$newpost);
        return view('posts.index',[
            'posts' => self::$posts,
        ]);
    }

    public function edit($postId)
    {

        return view("posts.edit",["post"=>self::$posts[$postId-1]]);
    }
    public function view($postId)
    {

        return view("posts.view",["post"=>self::$posts[$postId-1]]);
    }
    public function update(Request $request){
        $request_out=$request->all();
        // dd($request_out);
        self::$posts[$request_out['id']-1]['title']=$request_out['title'];
        self::$posts[$request_out['id']-1]['description']=$request_out['description'];
        self::$posts[$request_out['id']-1]['post_creator']=$request_out['creator'];


        return view('posts.index',[
            'posts' => self::$posts,
        ]);
    }
    public function delete($id){
        unset(self::$posts[$id-1]);
       // return route('posts.index');
      // return redirect()->route('posts.index');
        //dd($id);
        return view('posts.index',[
            'posts' => self::$posts,
        ]);
    }
}