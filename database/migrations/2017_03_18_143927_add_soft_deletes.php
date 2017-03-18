<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("species", function ($table) {            
            $table->softDeletes();
        });
        Schema::table("diseases", function ($table) {            
            $table->softDeletes();
        });
        Schema::table("systems", function ($table) {            
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
        Schema::table("species", function ($table) {
            $table->dropSoftDeletes();
        });
        Schema::table("diseases", function ($table) {
            $table->dropSoftDeletes();
        });
        Schema::table("systems", function ($table) {
            $table->dropSoftDeletes();
        });
    }
}
