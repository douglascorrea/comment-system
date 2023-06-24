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
    public function test_create_single_comment(): void
    {
        $response = $this->postJson('/api/comment', ['name' => 'John Doe',
            'body' => 'Hey this is my first comment!']);

        $response->assertStatus(201);
    }

    /**
     * Test create a comment with multiple childs and list it
     */
    public function test_create_comment_with_childs(): void
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
        $first_child_response->assertStatus(201);

        $list_response = $this->getJson('/api/comment');
        $list_response->assertStatus(200);
        // assert that the list contains only one top level
        $list_response->assertJsonCount(1);

        $child_comments = $list_response->decodeResponseJson()->json()[0]['child_comments'];
        assertEquals(count($child_comments), 2);

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
}
