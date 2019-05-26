<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->string('multimedia')->nullable();
            $table->string('tipo_multimedia')->nullable();
            $table->integer('administrador_id')->unsigned();
            $table->timestamps();

            $table->foreign('administrador_id')->references('id')->on('administradores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('noticias');
    }
}
