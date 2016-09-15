<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Saga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saga', function (Blueprint $table) {
            $table->increments('sag_id');
            $table->string('sag_nome');
            $table->integer('aut_id')->unsigned();
            $table->integer('sag_n_livros');
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
        Schema::drop('saga');
    }
}
