<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Livro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livro', function (Blueprint $table) {
            $table->increments('liv_id');
            $table->string('liv_nome');
            $table->integer('liv_livro_quadrinho'); //1 para LIVRO, 2 para QUADRINHO
            $table->integer('liv_n_ebook')->nullable();
            $table->integer('liv_n_fisico');
            $table->integer('aut_id')->unsigned()->nullable();
            $table->integer('sag_id')->unsigned()->nullable();
            $table->integer('liv_n_saga')->nullable();
            $table->timestamps();

            $table->foreign('aut_id')->references('aut_id')->on('autor');
            $table->foreign('sag_id')->references('sag_id')->on('saga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('livro');
    }
}
