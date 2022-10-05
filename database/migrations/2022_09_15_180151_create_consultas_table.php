<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->increments('cons_codigo');
            $table->integer('proc_codigo')->unsigned();
            $table->foreign('proc_codigo')->references('proc_codigo')->on('procedimentos');
            $table->integer('med_codigo')->unsigned();
            $table->foreign('med_codigo')->references('med_codigo')->on('medicos');
            $table->integer('pac_codigo')->unsigned();
            $table->foreign('pac_codigo')->references('pac_codigo')->on('pacientes');
            $table->date('data');
            $table->time('hora');
            $table->enum('particular', ['Sim', 'Nao'])->default('Sim');
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
        Schema::dropIfExists('consultas');
    }
};
