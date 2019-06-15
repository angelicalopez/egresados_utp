<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInteresesEgresadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intereses_egresados', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('interes_id')->unsigned();
            $table->integer('egresado_id')->unsigned();
            $table->timestamps();

            $table->foreign('interes_id')->references('id')->on('interes');
            $table->foreign('egresado_id')->references('id')->on('egresados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intereses_egresados');
    }
}
