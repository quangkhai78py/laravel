<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';
    protected $fillable = ['id','name','avatar','content'];

    public function comment(){
        return $this->hasMany('App\Models\Comment','id_blog','id');
    }
}
