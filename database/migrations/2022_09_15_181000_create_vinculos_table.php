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
        Schema::create('vinculos', function (Blueprint $table) {
            $table->increments('vinculo_codigo');
            $table->integer('pac_codigo')->unsigned();
            $table->foreign('pac_codigo')->references('pac_codigo')->on('pacientes');
            $table->integer('plan_codigo')->unsigned();
            $table->foreign('plan_codigo')->references('plan_codigo')->on('plano_saudes');
            $table->string('nr_contrato');
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
        Schema::dropIfExists('vinculos');
    }
};
