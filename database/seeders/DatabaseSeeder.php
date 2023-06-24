<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $comment_1 = Comment::factory()->create();

        $comments_2 = Comment::factory(2)->create([
            'parent_comment_id' => $comment_1->id,
        ]);
        $comments_3 = Comment::factory(3)->create([
            'parent_comment_id' => $comments_2[0]->id,
        ]);
        $comments_4 = Comment::factory(1)->create([
            'parent_comment_id' => $comments_2[1]->id,
        ]);

    }
}
