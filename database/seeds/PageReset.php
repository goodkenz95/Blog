<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Laravel\Models\Page;

class PageReset extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::truncate();
        Page::create(['id' => "1",'title' => "Privacy Policy",'user_id' => 1]);
        Page::create(['id' => "2",'title' => "Disclaimer",'user_id' => 1]);
        Page::create(['id' => "3",'title' => "Terms and Condition",'user_id' => 1]);

    }
}
