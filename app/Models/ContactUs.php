<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model {

    protected $fillable = ['name','company_name', 'email', 'phone_no', 'message', 'status', 'created_at', 'updated_at'];
    protected $table = 'contact_us';

}
