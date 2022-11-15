<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultiLingul extends Model
{
    protected $table = 'multilinguals';
    protected $fillable = ['lang','currency_code','country_code','lang_code','currency_symbol','status','created_at','updated_at'];
}
