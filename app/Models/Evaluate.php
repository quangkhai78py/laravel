<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluate extends Model
{
    protected $table = 'evaluate';
    protected $fillable = ['user_id','blog_id','product_id','evaluate'];
}
