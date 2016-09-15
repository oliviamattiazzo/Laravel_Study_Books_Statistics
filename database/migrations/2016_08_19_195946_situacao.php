<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Situacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('situacao', function (Blueprint $table) {
            $table->increments('sit_id');
            $table->integer('liv_id')->unsigned();
            $table->integer('sit_pag_atual');
            $table->timestamps();

            $table->foreign('liv_id')->references('liv_id')->on('livro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('situacao');
    }
}
