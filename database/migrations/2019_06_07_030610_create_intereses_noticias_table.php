<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInteresesNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intereses_noticias', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('interes_id')->unsigned();
            $table->integer('noticia_id')->unsigned();
            $table->timestamps();

            $table->foreign('interes_id')->references('id')->on('interes');
            $table->foreign('noticia_id')->references('id')->on('noticias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intereses_noticias');
    }
}
