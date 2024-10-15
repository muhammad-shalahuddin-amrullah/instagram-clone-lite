<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Posts;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'user_id' => 1,
                'caption' => 'First post caption user 1',
                'file' => 'uploads/default_post_image.jpg',
                'file_type' => 'image',
            ],
            [
                'user_id' => 2,
                'caption' => 'First post caption user 2',
                'file' => 'uploads/default_post_image2.jpg',
                'file_type' => 'image',
            ],
            // Add more posts as needed
        ];

        foreach ($posts as $post) {
            Posts::create($post);
        }
    }
}
