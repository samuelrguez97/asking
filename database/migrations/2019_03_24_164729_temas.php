<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Temas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('temas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tema');
            $table->integer('nPreguntas')->default(0);
        });

        $temas = array(
            array('tema' => 'General'),
            array('tema' => 'Coches'),
            array('tema' => 'Motos'),
            array('tema' => 'Estudios'),
            array('tema' => 'Fiestas'),
            array('tema' => 'Trabajo')
        );

        DB::table('temas')->insert($temas);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('temas');
    }
}
