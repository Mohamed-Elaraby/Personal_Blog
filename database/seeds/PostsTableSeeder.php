<?php

use Illuminate\Database\Seeder;
use App\Post;


class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0;$i < 5; $i++){
            Post::create([
                'content' => 'Post Content  Number '.rand(1,5),
                'user_id' => 1,
            ]);
        }
    }
}
