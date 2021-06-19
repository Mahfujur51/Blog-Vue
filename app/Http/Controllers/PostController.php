<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public  function  post(){
        $posts=Post::with('user','category')->get();

        return response()->json(['posts'=>$posts],200);
    }
    public  function  delete($id){
        $post=Post::findOrFail($id);
       $old='assets/fontend/post/'.$post->image;
        if ($post->delete()){
            unlink($old);
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
           $old='assets/fontend/post/'.$post->image;
           unlink($old);
           $post->delete();
           $s++;
       }
        $success=$s>0?true:false;
        return response()->json(['success'=>$success,'total'=>$s],200);

    }
    public  function  store(Request $request){

          $request->validate([
              'title'=>'required|min:5|max:150',
             'category_id'=>'required',
             'description'=>'required',
              'image'=>'required',
          ]);

        if($request->has('image')){

            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->resize(400,200)->save(public_path('assets/fontend/post/').$name);
            $request->merge(['image' => $name]);

        }
          $post=new Post();
          $post->title=$request->title;
          $post->user_id=Auth::user()->id;
          $post->description=$request->description;
          $post->category_id=$request->category_id;
          $post->image=$name;
          if ($post->save()){
              $success='true';
          }else{
              $success='false';
          }
          return response()->json(['success'=>$success],200);
    }
    public  function  editpost($id){
            $post=Post::findOrFail($id);
        return response()->json(['post'=>$post],200);

    }
    public  function  update(Request $request,$id){

        $request->validate([
            'title'=>'required|min:5|max:150',
            'category_id'=>'required',
            'description'=>'required',

        ]);
        $post=Post::findOrFail($id);
        $image='assets/fontend/post/'.$post->image;


        $post->title=$request->title;
        $post->user_id=Auth::user()->id;
        $post->description=$request->description;
        if ($request->image!== $post->image){
            if(file_exists(public_path($image))){
            unlink($image);
            }
            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->resize(400,200)->save(public_path('assets/fontend/post/').$name);
            $request->merge(['image' => $name]);
            $post->image=$name;
        }
        $post->category_id=$request->category_id;

        if ($post->update()){
            $success='true';
        }else{
            $success='false';
        }
        return response()->json(['success'=>$success],200);

    }
}
