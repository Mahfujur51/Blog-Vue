<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public  function  post(){
        $posts=Post::with('user','category')->get();

        return response()->json(['posts'=>$posts],200);
    }
    public  function  delete($id){
        $post=Post::findOrFail($id);
        if ($post->delete()){
            $success=true;
        }else{
            $success=false;
        }
        return response()->json(['success'=>$success],200);
    }
}
