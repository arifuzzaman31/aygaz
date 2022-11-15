<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsBlog extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'blogs';
    protected $fillable = ['parent_id', 'lang_code', 'title', 'description', 'image', 'status', 'created_at', 'updated_at'];
}
