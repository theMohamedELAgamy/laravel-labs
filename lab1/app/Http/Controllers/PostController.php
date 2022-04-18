<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\DataBase;
use App\Models\post;
use App\Models\User;
use App\Models\Comment;
class PostController extends Controller
{

   
    public function index()
    {
        // $post = post::find(50);
         //     foreach ($post->comments as $comment) {
        //         dd($comment);
        // };
            
     $posts=post::paginate(15);
     
       
       
        
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
        
         post::where('id',$request_out['id'])->update([
             'title'=>$request_out['title'],
             'description'=>$request_out['description'],
             'user_id'=>$request_out['creator']
         ]);

        return to_route('posts.index');
    }
    public function delete($id){
       
        post::where('id',$id)->delete();
        return to_route('posts.index');
    }
}