<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cylinder extends Model {

    public $timestamps = false;
    protected $table = 'gas_cylinder';
    protected $fillable = ['weight','image','price','status','created_at','updated_at'];

    // public function categories()
    // {
    //     return $this->hasMany(Category::class, 'parent_id')->where('status','1');
    // }

    // public function childrenCategories()
    // {
    //     return $this->hasMany(Category::class,'parent_id')->where('status','1')->with('categories');
    // }
}
