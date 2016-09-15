<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Autor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autor', function (Blueprint $table) {
            $table->increments('aut_id');
            $table->string('aut_nome');
            $table->integer('aut_sexo'); //1 para LIVRO, 2 para QUADRINHO
            $table->integer('aut_cor');
            $table->integer('aut_continente');
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
        Schema::drop('autor');
    }
}
