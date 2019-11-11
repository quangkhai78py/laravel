<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History_oder extends Model
{
    protected $table = 'history_oder';
    protected $fillable = ['id','user_id','product_name','quantily','price'];
}
