<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_post_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->assertEquals($user->id, $post->user->id);
    }

    /**
     * @test
     */
    public function a_post_has_a_title_and_body()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'title' => 'Test Post',
            'body' => 'This is the body of the post.',
            'user_id' => $user->id
        ]);

        $this->assertEquals('Test Post', $post->title);
        $this->assertEquals('This is the body of the post.', $post->body);
    }

    /**
     * @test
     */
    public function a_post_has_correctly_set_user_id()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->assertEquals($user->id, $post->user_id);
    }
}

