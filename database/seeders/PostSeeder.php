<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //\
         $data = [
            [
                'title' => 'Post Admin',
                'content' => 'This is new post',
                'date' => date('Y-m-d'),
                'user_id'=> User::first()->id 
            ]
        ];
        Post::insert($data);  
    }
}