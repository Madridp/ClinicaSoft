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
        Schema::create('examen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipo_examen');
            $table->date('fecha');
            $table->unsignedBigInteger('id_paciente');
            $table->decimal('valor_examen', 10, 2);
            $table->integer('examen_pagado');
            $table->unsignedBigInteger('id_tecnico');
            $table->unsignedBigInteger('id_medico_referente')->nullable();
            $table->string('motivo', 200);
            $table->string('adjunto_orden', 255)->nullable();
            $table->datetime('tiempo_estimado_respuesta')->nullable();
            $table->string('documento_resultado', 255)->nullable();
            $table->integer('estado')->default(1);
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->timestamps();

            $table->foreign('id_tipo_examen')->references('id')->on('tipo_examen');
            $table->foreign('id_paciente')->references('id')->on('paciente');
            $table->foreign('id_tecnico')->references('id')->on('tecnico');
            $table->foreign('id_medico_referente')->references('id')->on('medico_referente');
            $table->foreign('id_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examen');
    }
};
