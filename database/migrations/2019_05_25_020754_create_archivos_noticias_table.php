<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivosNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos_noticias', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string("nombre", 100);
            $table->string("ruta", 200);
            $table->integer("noticia_id")->unsigned();
            $table->timestamps();

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
        Schema::table('archivos_noticias', function (Blueprint $table) {
            //
        });
    }
}
