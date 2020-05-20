<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuponesDiariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupones_diarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('negocio_id');
            $table->string('tipo',10);
            $table->string('codigo',200);
            $table->string('descripcion',200);
            $table->date('caducidad');
            $table->integer('usos');
            $table->integer('activo');
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
        Schema::dropIfExists('cupones_diarios');
    }
}
