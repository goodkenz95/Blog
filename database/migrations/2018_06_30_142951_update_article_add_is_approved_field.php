<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateArticleAddIsApprovedField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article', function ($table) {
            $table->string('is_approved')->nullable()->default("pending")->after('filename');
            $table->string('status')->nullable()->default("draft")->after('filename');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article', function ($table) {
            $table->dropColumn(['status','is_approved']);
        });
    }
}
