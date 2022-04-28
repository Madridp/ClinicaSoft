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
        Schema::create('compra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proveedor')->nullable();
            $table->date('fecha_compra');
            $table->date('fecha_recibe')->nullable();
            $table->decimal('total_compra', 10, 2);
            $table->string('no_factura', 45)->nullable();
            $table->unsignedBigInteger('id_tipo_compra');
            $table->integer('dias_credito')->nullable();
            $table->integer('estado')->default(1);
            $table->timestamps();

            $table->foreign('id_proveedor')->references('id')->on('proveedor');
            $table->foreign('id_tipo_compra')->references('id')->on('tipo_compra');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra');
    }
};
