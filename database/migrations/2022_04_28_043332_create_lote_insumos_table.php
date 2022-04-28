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
        Schema::create('lote_insumo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_compra');
            $table->date('fecha_vencimiento')->nullable();
            $table->unsignedBigInteger('id_insumo');
            $table->string('no_lote', 45);
            $table->integer('cantidad');
            $table->integer('existencia');
            $table->decimal('precio_compra', 10, 2);
            $table->decimal('descuento', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->integer('estado')->default(1);
            $table->timestamps();

            $table->foreign('id_compra')->references('id')->on('compra');
            $table->foreign('id_insumo')->references('id')->on('insumo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lote_insumo');
    }
};
