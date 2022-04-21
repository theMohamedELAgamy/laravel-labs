<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
class CommentController extends Controller
{
    public static function add_comment($id,$content,$user_id){
        
        $post = Post::find($id);
        
        $post->comments()->create([
            'comment'=>$content,
            'user_id' => $user_id,
        ]);
        return response(["content"=>$content,
            "id"=>$id
    ]);

    }
   
}
