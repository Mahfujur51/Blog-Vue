<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public  function  post(){
        $posts=Post::with('user','category')->get();

        return response()->json(['posts'=>$posts],200);
    }
    public function singlepost($id){
         $post=Post::with('user','category')->where('id',$id)->first();
         return response()->json(['post'=>$post],200);
    }
    public  function  blogCategory(){
        $categories=Category::where('status',1)->get();
        return response()->json(['categories'=>$categories],200);
    }
    public  function latestPost(){
        $posts=Post::with('user','category')->orderBy('id','desc')->limit(6)->get();

        return response()->json(['posts'=>$posts],200);
    }
    public  function  categoryPost($id){
        $posts=Post::with('user','category')->where('category_id',$id)->orderBy('id','desc')->limit(6)->get();
        return response()->json(['posts'=>$posts],200);
    }
    public  function  search(){
        $search=\Request::get('s');
        if ($search!=NULL){

            $posts=Post::with('user','category')->where('title','LIKE',"%$search%")
                ->OrWhere('description','LIKE',"%$search%")
                ->get();

            return response()->json(['posts'=>$posts],200);
        }else{
           return $this->post();
        }



    }
}
