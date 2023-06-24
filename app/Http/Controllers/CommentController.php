<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Comment::commentsAndChilds()
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        // parent comment should exists
        // and the parent should has less than the max parents allowed by config
        $parent_comment = Comment::find($request->parent_comment_id);
        $prohibited_if = $parent_comment && $parent_comment->hasMaxParents();
        $attributes = $request->validate([
            'name' => 'required',
            'body' => 'required',
            'parent_comment_id' => [Rule::exists('comments', 'id'),
                Rule::prohibitedIf($prohibited_if)]
        ]);

        $comment = Comment::create($attributes);

        return $comment;
    }

}
