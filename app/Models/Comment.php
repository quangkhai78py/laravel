<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    protected $fillable = ['id','id_user','id_blog','product_id','comment','avatar','id_comment','active'];

}
