<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleReactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_reaction', function(Blueprint $table)
        {
            $table->increments('id');
            $table->bigInteger('article_id')->unsigned()->default("0");
            $table->bigInteger('user_id')->unsigned()->default("0");
            $table->string('type')->default("like");
            $table->string('is_active')->default('no');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_reaction');
    }
}
