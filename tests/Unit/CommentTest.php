<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_comment_belongs_to_a_user()
    {
        $comment = Comment::factory()->create();

        $this->assertInstanceOf(User::class, $comment->user);
    }

    /**
     * @test
     */
    public function a_comment_cannot_be_created_without_a_user()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Comment::factory()->create(['user_id' => null]);
    }

    /**
     * @test
     */
    public function a_comment_requires_a_user_id_when_created()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Comment::create([
            'text' => 'Sample Comment',
            'post_id' => Post::factory()->create()->id,
        ]);
    }

    /**
     * @test
     */
    public function a_comment_belongs_to_a_post()
    {
        $post = Post::factory()->create();
        $comment = Comment::factory()->create(['post_id' => $post->id]);

        $this->assertInstanceOf(Post::class, $comment->post);
    }
}
