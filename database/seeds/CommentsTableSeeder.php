<?php

use Illuminate\Database\Seeder;
use App\Comment;


class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0;$i < 10; $i++){
            Comment::create([
                'content' => 'Comment Number '.rand(20,50),
                'user_id' => 1,
                'post_id' => rand(1,5),
            ]);
        }
    }
}
