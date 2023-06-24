<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $visible = ['name', 'body', 'childComments'];

    public function scopeCommentsAndChilds($query)
    {
        return $query->with('childComments.childComments.childComments')
            ->whereNull('parent_comment_id')
            ->latest();
    }

    public function childComments()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }

}
