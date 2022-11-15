<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class UserMaster extends Model implements Authenticatable {

    use \Illuminate\Auth\Authenticatable;

    protected $table = 'user_master';
    protected $fillable = ['type_id','tax_id','name', 'first_name', 'last_name', 'password', 'email','business_number', 'phone', 'other_number','about_me', 'address_line1','gender','location','category','type',
        'city', 'state', 'zip','dob','profile_picture','user_verified','company_name','url','type','no_of_store','residential','contract','resume','remark','active_token','login_type', 'status', 'reset_password_token','is_plan_used','subscription_end', 'created_by', 'updated_by','last_login','avaliable'
        ];
    
    public function cat() {
        return $this->belongsTo('App\Models\Category', 'category', 'id');
    }

}
