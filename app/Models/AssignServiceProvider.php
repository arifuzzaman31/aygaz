<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignServiceProvider extends Model {

    protected $table = 'assign_service_provider';
    protected $fillable = ['request_id', 'service_provider_id','status'];

    

}
