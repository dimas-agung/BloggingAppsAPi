<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['comments'];
    protected $withCount = [ 'comments','likes' ];
    public function likes() 
    {
        return $this->hasMany(PostLike::class, 'post_id');
    }
    public function comments() 
    {
        return $this->hasMany(PostComment::class, 'post_id');
    }
}