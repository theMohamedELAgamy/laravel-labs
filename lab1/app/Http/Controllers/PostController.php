<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\DataBase;
use App\Models\post;
use App\Models\User;
class PostController extends Controller
{

    // public  static $posts = [
    //     ['id' => 1, 'title' => 'Laravel', 'post_creator' => 'Ahmed', 'created_at' => '2022-04-16 10:37:00','description'=>"laravel course"],
    //     ['id' => 2, 'title' => 'PHP', 'post_creator' => 'Mohamed', 'created_at' => '2022-04-16 10:37:00','description'=>"PHP course"],
    //     ['id' => 3, 'title' => 'Javascript', 'post_creator' => 'Ali', 'created_at' => '2022-04-16 10:37:00','description'=>"Javascript course"],
    // ];
   // public static $num_posts=3;
    public function index()
    {
       $posts=post::all();
        
        
        return view('posts.index',[
            'posts' => $posts,
        ]);
    }

    public function create()
    {     $users = User::all();

        return view('posts.create',[
            'users' => $users,
        ]);
        //return view('posts.create');
    }

    public function store(Request $request)
    {   
            $request_out=$request->all();
        //self::$num_posts =(self::$num_posts) +1;
       // $newpost=['id' => (self::$num_posts), 'title' => $request_out['title'], 'post_creator' => $request_out['creator'], 'created_at' => '2022-04-16 10:37:00','description'=>$request_out['description']];
       // array_push( self::$posts,$newpost);
            post::create([
                'title' =>  $request_out['title'],
                'description' =>  $request_out['description'],
                'user_id' => $request_out['creator'],
            
            ]);
            return to_route('posts.index');
    }

    public function edit($postId)
    {
        $post=post::find($postId);
        $users = User::all();
        return view("posts.edit",["post"=>$post,"users"=>$users]);
    }

    public function view($postId)
    {
        $post=post::find($postId);
        return view("posts.view",["post"=>$post]);
    }

    public function update(Request $request){
        $request_out=$request->all();
        // dd($request_out);
        // self::$posts[$request_out['id']-1]['title']=update users set votes = 100 where name = ?;
        // self::$posts[$request_out['id']-1]['description']=$request_out['description'];
        // self::$posts[$request_out['id']-1]['post_creator']=$request_out['creator'];
        $user_id=User::select('select id from users where id = ?', [$request_out['creator']]);
        post::update("update posts set title =? && description=? && user_id=? where id = ?",$request_out['title'],$request_out['description'],[$user_id],[$request_out['id']]);


        return to_route('posts.index');
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