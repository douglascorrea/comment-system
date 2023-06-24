<?php

namespace App\Http\Requests;

use App\Models\Comment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // validate request
        // parent comment should exists
        // and the parent should has less than the max parents allowed by config
        $parent_comment = Comment::find($this->parent_comment_id);
        $prohibited_if = $parent_comment && $parent_comment->hasMaxParents();
        return [
            'name' => 'required',
            'body' => 'required',
            'parent_comment_id' => [Rule::exists('comments', 'id'),
                Rule::prohibitedIf($prohibited_if)]
        ];
    }
}
