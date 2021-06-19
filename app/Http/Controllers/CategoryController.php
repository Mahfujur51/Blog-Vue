<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public  function  index(){
       $categories=Category::all();
       return response()->json(['categories'=>$categories],200);
    }
    public function  store(Request $request){
        $request->validate([
           'name'=>'required',
            'status'=>'required'
        ]);
        $category=new Category();
        $category->name=$request->name;
        $category->status=$request->status;
        $category->save();
        return ['message'=>'ok'];
    }
    public  function  delete($id){
        $category=Category::findOrFail($id);
        $category->delete();


//      return response()->json([
//          'test'=>$category
//      ],200);
    }
    public  function  edit($id){
        $category=Category::findOrFail($id);
        return response()->json(['category'=>$category],200);

    }
    public  function  update(Request  $request,$id){
        $request->validate([
            'name'=>'required',
            'status'=>'required'
        ]);
        $category=Category::findOrFail($id);
        $category->name=$request->name;
        $category->status=$request->status;
        if ($category->update()){
            $success=true;
        }else{
            $success=false;
        }

       return response()->json(['success'=>$success],200);

    }
    public  function  deleteItems(Request  $request){
        $s=0;
          foreach ($request->data as $id) {
              $category = Category::findOrFail($id);
              $category->delete();
              $s++;
          }
          $success=$s>0?true:false;
          return response()->json(['success'=>$success,'total'=>$s],200);
    }
    public  function  ChangeStatus(Request $request){
        $s=0;
        foreach ($request->data as $id){
            $category=Category::findOrFail($id);
            $category->status=$request->status;
            $category->update();
            $s++;
        }
        $success=$s>0?true:false;
        return response()->json(['success'=>$success,'total'=>$s],200);
    }
    public  function  getActive(){
        $categories=Category::where('status',1)->get();
        return response()->json(['categories'=>$categories],200);

    }
}
