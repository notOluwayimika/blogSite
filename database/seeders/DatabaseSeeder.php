<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::truncate();
        // Category::truncate();
        // Post::truncate();
        $user = User::factory()->create([
            'name' => "Oluwayimika Ojo-Bello"
        ]);

        Comment::factory(1)->create([
            'user_id' => $user->id
        ]);

    }
}
