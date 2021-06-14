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
    public function deleteItems(Request $request){
        $s=0;
       foreach ($request->data as $id){
           $post=Post::findOrFail($id);
           $post->delete();
           $s++;
       }
        $success=$s>0?true:false;
        return response()->json(['success'=>$success,'total'=>$s],200);

    }
//    public  function  changeStatus(Request $request){
//        $s=0;
//        foreach ($request->data as $id){
//            $post=Post::findOrFail($id);
//            $post->status=$request->status;
//            $post->update();
//            $s++;
//        }
//        $success=$s>0?true:false;
//        return response()->json(['success'=>$success,'total'=>$s],200);
//
//
//    }
}
