<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hirefixer extends Model {

    protected $table = 'hire_fixers';
    protected $fillable = ['name', 'email', 'phone', 'title','deadline','budget','description','currency', 'category', 'address','zipcode','term_condition','status'];

    public function files() {
        return $this->hasMany(RequestFile::class, 'request_id', 'id')->where('request_type',"2")->where('status', '1');
    }

    public function assign() {
        return $this->belongsTo(AssignServiceProvider::class, 'request_id', 'id')->where('status', '1');
    }

}
