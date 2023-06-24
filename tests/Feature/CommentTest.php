<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class CommentTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test create a single comment happy path
     */
    public function test_it_should_create_single_comment(): void
    {
        $response = $this->postJson('/api/comment', ['name' => 'John Doe',
            'body' => 'Hey this is my first comment!']);

        $response->assertStatus(201);
    }

    /**
     * Test create a comment with multiple childs and list it
     */
    public function test_it_should_create_comment_with_childs_and_list_it(): void
    {
        $parent_response = $this->postJson('/api/comment', ['name' => 'John Doe',
            'body' => 'Hey this is my first comment!']);
        $parent_id = $parent_response['id'];

        $parent_response->assertStatus(201);

        $first_child_response = $this->postJson('/api/comment', ['name' => 'Jane Doe',
            'body' => 'Hey this is my first reply comment!', 'parent_comment_id' => $parent_id]);
        $first_child_response->assertStatus(201);

        $second_child_response = $this->postJson('/api/comment', ['name' => 'Danny Doe',
            'body' => 'Hey this is my second reply comment!', 'parent_comment_id' => $parent_id]);
        $second_child_response->assertStatus(201);

        $list_response = $this->getJson('/api/comment');
        $list_response->assertStatus(200);
        // assert that the list contains only one top level
        $list_response->assertJsonCount(1);

        $child_comments = $list_response->decodeResponseJson()->json()[0]['child_comments'];
        assertEquals(count($child_comments), 2);

    }

    /**
     * Test comment basic validations
     */
    public function test_it_should_not_create_without_name(): void
    {
        $response = $this->postJson('/api/comment', ['body' => 'This is a comment without a name']);

        $response->assertStatus(422);
        $response->assertJsonFragment(['name' => ['The name field is required.']]);

    }

    public function test_it_should_not_create_without_body(): void
    {
        $response = $this->postJson('/api/comment', ['name' => 'John Doe']);

        $response->assertStatus(422);
        $response->assertJsonFragment(['body' => ['The body field is required.']]);

    }

    public function test_it_should_not_create_invalid_parent(): void {
        $response = $this->postJson('/api/comment', ['name' => 'John Doe',
            'body' => 'Hey this is my first comment!',
            'parent_comment_id' => 'invalid']);

        $response->assertStatus(422);
        $response->assertJsonFragment(['parent_comment_id' => ['The selected parent comment id is invalid.']]);
    }


    /**
     * Test create a single comment invalid parent
     */
    public function test_create_invalid_parent_comment(): void
    {
        $response = $this->postJson('/api/comment', ['name' => 'John Doe',
            'body' => 'Hey this is my first comment!',
            'parent_comment_id' => 10000]);

        $response->assertStatus(422);
    }

    /**
     * Test comment validation too deep (more than 3 levels)
     */
    public function test_it_should_not_allow_comment_too_depp(): void
    {
        $parent_response = $this->postJson('/api/comment', ['name' => 'John Doe',
            'body' => 'Hey this is my first comment!']);
        $parent_id = $parent_response['id'];

        $parent_response->assertStatus(201);

        $how_deep_is_allowed = config('comment.how_deep_comments_are_allowed');
        for($i = 0; $i < $how_deep_is_allowed; $i++) {
            $child_response = $this->postJson('/api/comment', ['name' => 'Jane Doe',
                'body' => 'Hey this is my first reply comment!', 'parent_comment_id' => $parent_id]);
            $child_response->assertStatus(201);
            $parent_id = $child_response['id'];
        }
        $child_response = $this->postJson('/api/comment', ['name' => 'Jane Doe',
            'body' => 'Hey this is my first reply comment!', 'parent_comment_id' => $parent_id]);
        $child_response->assertStatus(422);
        $child_response->assertJsonFragment(['parent_comment_id' => ['The parent comment id field is prohibited.']]);


    }
}
