<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslate extends Model
{
    protected $table = 'categories_translation';
    protected $fillable = ['name','category_id','language_code','status','created_at','updated_at'];
    
    public function get_category($id,$lang){
        $check = $this->where('category_id',$id)->where('language_code',$lang)->first();
        if (empty($check)) {
            return '';
        }else{
            return $check->name;
        }
    }
}
