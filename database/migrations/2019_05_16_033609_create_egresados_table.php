<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEgresadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egresados', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('apellidos');
            $table->string('dni', 100)->unique();
            $table->string('genero', 50)->nullable();
            $table->boolean('manejo_datos');
            $table->integer('edad')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('pais_id')->unsigned();
            $table->string('imagen', 200)->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('pais_id')->references('id')->on('paises');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('egresados');
    }
}
