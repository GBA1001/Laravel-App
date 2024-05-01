<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\user;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Roles;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        user::factory(5)
            ->has(Address::factory())
            ->has(Roles::factory())
            ->has(Post::factory(5)
                ->has(Category::factory())
                ->has(Comment::factory()))
            ->create();
    }
}
