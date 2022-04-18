<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\DataBase;
use App\Http\Requests\StorePostRequest;
use App\Models\post;
use App\Models\User;
use App\Models\Comment;

class PostController extends Controller
{

   
    public function index()
    {
      
          $posts=post::paginate(15);
        return view('posts.index',[
            'posts' => $posts,
        ]);
    }

    public function create()
    {    
            $users = User::all();
            return view('posts.create',[
                'users' => $users,
            ]);
        
    }

    public function store(Request  $request)
    { 
           // $request->validated(); 
            $request_out=$request->all();
       
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
        $comments= $post->comments;
        return view("posts.view",["post"=>$post,'comments'=>$comments]);
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