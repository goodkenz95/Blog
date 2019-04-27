<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDeviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_device', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->text('reg_id');
            $table->string('device_id',100);
            $table->enum('device_name',["android","ios"])->default("android");
            $table->enum('is_login',["1","0"])->default("1");
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
        Schema::dropIfExists('user_device');
    }
}
