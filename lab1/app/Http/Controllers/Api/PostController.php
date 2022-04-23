<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\StorePostRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    function index(){
        $posts=post::paginate(1);
        return PostResource::collection($posts);
    }

    function show($id){
        $post = Post::find($id);

        return new PostResource($post);
    }
    function store(StorePostRequest  $request){
        $data = request()->all();
        $post = Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
            
        ]);

       
        return new PostResource($post);

    }
}
