<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('review');
            $table->text('exams');
            $table->text('treatment');

            $table->integer('species_id')->unsigned();
            $table->foreign('species_id')->references('id')->on('species');

            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('diseases');
    }
}
