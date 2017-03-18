<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('photo')->nullable(); //extension jpg, png
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('species');
    }
}
