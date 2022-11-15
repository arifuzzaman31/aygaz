<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoGas extends Model
{
    use HasFactory;
    protected $table = 'auto_gas';
    protected $fillable = ['weight', 'image', 'price', 'status', 'city', 'date', 'created_at', 'updated_at'];
}
