<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    public $timestamps = false;
    protected $table = 'categories';
    protected $fillable = ['parent_id','image','name','status','created_at','updated_at'];

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('status','1');
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class,'parent_id')->where('status','1')->with('categories');
    }
}
