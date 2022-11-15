<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestFile extends Model {

    protected $table = 'requestfiles';
    protected $fillable = ['request_id','request_type', 'file_type', 'file_name', 'is_default', 'status'];

}
