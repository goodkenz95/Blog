<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_info', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('name_id')->nullable();
            $table->date('birthday')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->text('email')->nullable();
            $table->text('homeaddress')->nullable();
            $table->text('municipality')->nullable();
            $table->text('province')->nullable();
            $table->text('region')->nullable();
            $table->text('businessaddress')->nullable();
            $table->text('preffered_schedule')->nullable();
            $table->text('businessname')->nullable();

            $table->text('path')->nullable();
            $table->text('directory')->nullable();
            $table->string('filename')->nullable();

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
        Schema::dropIfExists('personal_info');
    }
}
