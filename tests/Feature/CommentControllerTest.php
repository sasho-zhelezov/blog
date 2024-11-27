<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_user_can_create_a_comment_for_a_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $commentData = [
            'text' => 'This is a comment on the post',
            'user_id' => $user->id,
            'post_id' => $post->id,
        ];

        $response = $this->actingAs($user)->post(route('post.comment.store', ['post' => $post->id]), $commentData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('comments', $commentData);
    }

    /**
     * @test
     */
    public function a_comment_requires_a_user_to_be_authenticated()
    {
        $post = Post::factory()->create();

        $commentData = [
            'text' => 'This comment is missing user authentication',
            'post_id' => $post->id,
        ];

        $response = $this->post(route('post.comment.store', ['post' => $post->id]), $commentData);

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function a_user_can_edit_their_comment()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $updatedData = [
            'text' => 'Updated comment text',
        ];

        $response = $this->actingAs($user)->put(route('post.comment.update', ['post' => $post->id, 'comment' => $comment->id]), $updatedData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'text' => 'Updated comment text',
        ]);
    }

    /**
     * @test
     */
    public function a_user_can_delete_their_comment()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $response = $this->actingAs($user)->delete(route('post.comment.destroy', ['post' => $post->id, 'comment' => $comment->id]));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);
    }

    /**
     * @test
     */
    public function a_post_displays_comments_and_subcomments()
    {

        $user = User::factory()->create();
        $post = Post::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $subcomment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'parent_id' => $comment->id,
        ]);

        $response = $this->get(route('post.show', ['post' => $post->id]));

        $response->assertStatus(200);
        $response->assertSee($post->title);
        $response->assertSee($comment->text);
        $response->assertSee($subcomment->text);
    }
}
