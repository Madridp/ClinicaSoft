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
        Schema::create('proceso_examen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_examen');
            $table->unsignedBigInteger('id_lote_insumo');
            $table->integer('cantidad_utilizada');
            $table->string('observacion', 255)->nullable();
            $table->integer('estado')->default(1);
            $table->unsignedBigInteger('id_usuario');
            $table->timestamps();

            $table->foreign('id_examen')->references('id')->on('examen');
            $table->foreign('id_lote_insumo')->references('id')->on('lote_insumo');
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
        Schema::dropIfExists('proceso_examen');
    }
};
