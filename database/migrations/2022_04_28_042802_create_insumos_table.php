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
        Schema::create('insumo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipo_insumo');
            $table->string('codigo', 200);
            $table->string('nombre', 200);
            $table->integer('es_reactivo');
            $table->integer('estado')->default(1);
            $table->timestamps();

            
            $table->foreign('id_tipo_insumo')->references('id')->on('tipo_insumo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insumo');
    }
};
