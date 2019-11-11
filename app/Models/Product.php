<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $table = 'product';

   protected $fillable = ['id','brand_id','category_id','user_id','avatar','product','price','quantily','description','size_id'];
}
