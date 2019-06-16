<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmigosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amigos', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('egresado_id')->unsigned();
            $table->integer('amigo_id')->unsigned();
            $table->timestamps();

            $table->foreign('egresado_id')->references('id')->on('egresados');
            $table->foreign('amigo_id')->references('id')->on('egresados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amigos');
    }
}
