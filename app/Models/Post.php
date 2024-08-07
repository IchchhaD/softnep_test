<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Comment;

class Post extends Model
{
    protected $table = "posts";

    protected $fillable = ['title', 'description', 'created_by'];

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
