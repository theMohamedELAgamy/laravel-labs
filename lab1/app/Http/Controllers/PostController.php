<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

use App\Http\Controllers\DataBase;
use App\Http\Requests\StorePostRequest;
use App\Models\post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PostController extends Controller
{

    
    public function index()
    {
          $posts=post::paginate(15);
        return view('posts.index',[
            'posts' => $posts,
        ]);
    }

    public function create(){
             $users = User::all();
            return view('posts.create',[
                'users' => $users,
            ]);
        
    }

    public function store(StorePostRequest  $request){
        $validated= $request->validated();    
        $new_name=null;
        if($request['select_file']){
            $image = $request->file('select_file');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name); 
        } 
        $post= post::create([
            'title' =>  $validated['title'],
            'description' =>  $validated['description'],
            'user_id' => $validated['creator'],
            'image_path'=>$new_name
         ]);  
            return to_route('posts.index');
    }

    public function edit($postId){
        $post=post::find($postId);
        $users = User::all();
        return view("posts.edit",["post"=>$post,"users"=>$users]);
    }

    public function view($postId){
        $post=post::find($postId);
        $comments= $post->comments;
        return view("posts.view",["post"=>$post,'comments'=>$comments]);
    }

    public function update(StorePostRequest  $request){
              $validated= $request->validated();    
                $request_out=$request->all();
                if($request['select_file']){
                    $post= post::find($validated['id']);
                    File::delete(public_path('images/'.$post['image_path'])); 
                    $image = $request->file('select_file');
                    $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $new_name); 
                    post::where('id',$validated['id'])->update([
                        'title'=>$validated['title'],
                        'description'=>$validated['description'],
                        'user_id'=>$validated['creator'],
                        'image_path'=>$new_name,
                        'slug'
                    ]);
                }else{
                    post::where('id',$request_out['id'])->update([
                        'title'=>$request_out['title'],
                        'description'=>$request_out['description'],
                        'user_id'=>$request_out['creator']
                        
                    ]);

                }

                return to_route('posts.index');
    }
    public function delete(Request $request){
        $request_out=$request->all();
       $post= post::find($request_out['id']);
        File::delete(public_path('images/'.$post['image_path']));
         post::where('id',$request_out['id'])->delete();
         Comment::where('commentable_id',$request_out['id'])->delete();
         return to_route('posts.index');
    }

    
}