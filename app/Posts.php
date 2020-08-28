<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use SoftDeletes;

    protected $fillable = ['judul', 'category_id', 'content', 'gambar', 'slug', 'users_id'];
    protected $table = 'posts';

    public function category()
    {
        return $this->belongsTo('App\category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tags');
    }

    public function users() {
        return $this->belongsTo('App\User', 'users_id', 'id');
    }
}
