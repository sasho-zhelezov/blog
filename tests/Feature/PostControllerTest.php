<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_user_can_view_all_posts_with_pagination()
    {

        $user = User::factory()->create();

        $posts = Post::factory()->count(12)->create(['user_id' => $user->id]);

        $response = $this->get(route('post.index'));

        $response->assertStatus(200);

        $posts = Post::with('user','comments')->paginate(10);

        foreach ($posts as $post) {
            $capitalizedTitle = ucwords($post->title); // Capitalize the title
            $response->assertSee($capitalizedTitle);
        }

        $response->assertSee('Next');
        $response->assertSee('Previous');
    }

    /**
     * @test
     */
    public function a_user_can_view_a_single_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('post.show', ['post' => $post->id]));

        $response->assertStatus(200);
        $response->assertSee($post->title);
        $response->assertSee($post->body);
    }

    /**
     * @test
     */
    public function a_user_is_redirected_if_post_does_not_exist()
    {
        $response = $this->get(route('post.show', ['post' => 999]));

        $response->assertStatus(404);
    }
}

