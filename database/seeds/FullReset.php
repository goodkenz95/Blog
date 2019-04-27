<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Laravel\Models\User;
use App\Laravel\Models\Article;
use App\Laravel\Models\ArticleComment;
use App\Laravel\Models\ArticleReaction;



class FullReset extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Article::truncate();
        ArticleComment::truncate();
        ArticleReaction::truncate();

        $this->call(AdminAccountSeeder::class);

    }
}
