<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_manager', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('custom_filename')->nullable();
            $table->string('type')->default("file")->nullable(); //file, image
            $table->text('directory')->nullable();
            $table->string('filename',150)->nullable();
            $table->text('path')->nullable();
            $table->string('source')->nullable()->default("file"); //file,azure
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
        Schema::drop('file_manager');
    }
}
