<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $users = User::factory(100)->create();

        for ($i = 0; $i < 30; $i++) {
            Post::factory()->create([
                'user_id' => $users->random()->id
            ]);
        }

        $posts = Post::all();

        for ($i = 0; $i < 200; $i++) {
            Comment::factory()->create([
                'post_id' => $posts->random()->id,
                'user_id' => $users->random()->id
            ]);
        }

        User::factory()->create([
            'name' => 'Sasho Zhelezov',
            'email' => 'sashojelezov@gmail.com',
            'password' => 'password'
        ]);
    }
}
