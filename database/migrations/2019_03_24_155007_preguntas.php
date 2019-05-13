<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Preguntas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('preguntas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_usuario');
            $table->string('pregunta');
            $table->string('tema');
            $table->bigInteger('likes')->default(0);
            $table->boolean('respuesta')->default(false);
            $table->string('by_usuario')->default("");
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('preguntas');
    }
}
