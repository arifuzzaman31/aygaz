<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requrirement extends Model {

    protected $fillable = ['name', 'email', 'phone', 'title','deadline','budget','description', 'category', 'address','zipcode','term_condition','status'];

    public function files() {
        return $this->hasMany(RequestFile::class, 'request_id', 'id')->where('request_type',"1")->where('status', '1');
    }

    public function assign() {
        return $this->belongsTo(AssignServiceProvider::class, 'request_id', 'id')->where('status', '1');
    }

}
