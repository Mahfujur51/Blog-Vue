<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['category_id','user_id','comment_id','title','description','image'];
    public  function  category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public  function  user(){
    return $this->belongsTo(User::class,'user_id','id');
   }
}
