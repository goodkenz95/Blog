<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserDeviceTableAddDeviceModelField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_device', function ($table) {
            $table->string('device_model')->nullable()->after('is_login');
            $table->string('device_imei')->nullable()->after('is_login');
            $table->string('os_version')->nullable()->after('is_login');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_device', function ($table) {
            $table->dropColumn(['device_model','device_imei','os_version']);
        });
    }
}
