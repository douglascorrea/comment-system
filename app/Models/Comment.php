<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $visible = ['name', 'body', 'child_comments'];

    public function child_comments()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }

}
