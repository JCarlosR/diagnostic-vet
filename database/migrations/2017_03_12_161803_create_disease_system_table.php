<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiseaseSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_system', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('disease_id')->unsigned();
            $table->foreign('disease_id')->references('id')->on('diseases');

            $table->integer('system_id')->unsigned();
            $table->foreign('system_id')->references('id')->on('systems');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disease_system');
    }
}
