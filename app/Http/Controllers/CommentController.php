<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
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
    public function store(CommentRequest $request)
    {
        // the request is validated by the CommentRequest class

        $comment = Comment::create($request->all());

        return $comment;
    }

}
