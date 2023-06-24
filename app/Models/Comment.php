<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'body', 'parent_comment_id'];
    protected $visible = ['id','name', 'body', 'childComments', 'created_at'];


    public function scopeCommentsAndChilds($query)
    {
        return $query->with(self::getChildCommentsClause())
            ->whereNull('parent_comment_id')
            ->latest();
    }

    public function childComments()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }

    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    public function hasMaxParents()
    {
        return $this->howDeepParents() >= config('comment.how_deep_comments_are_allowed');
    }


    public function howDeepParents()
    {
        $count = 0;
        $parent = $this->parentComment;
        while ($parent) {
            $count++;
            $parent = $parent->parentComment;
        }
        return $count;
    }

    private static function getChildCommentsClause()
    {

        return collect(range(0, config('comment.how_deep_comments_are_allowed')-1))
            ->map(fn($_) => "childComments")
            ->join('.');

    }

}
