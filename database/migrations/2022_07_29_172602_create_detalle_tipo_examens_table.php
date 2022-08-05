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
        Schema::create('detalle_tipo_examen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_examen')->nullable();
            $table->unsignedBigInteger('id_tipo_examen')->nullable();
            $table->decimal('valor_examen', 10, 2);
            $table->decimal('descuento', 10, 2)->nullable();
            $table->decimal('total_examen', 10, 2);
            $table->integer('estado')->default(1);
            $table->timestamps();

            $table->foreign('id_examen')->references('id')->on('examen');
            $table->foreign('id_tipo_examen')->references('id')->on('tipo_examen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_tipo_examen');
    }
};
