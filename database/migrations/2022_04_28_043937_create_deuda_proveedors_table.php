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
        Schema::create('deuda_proveedor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proveedor');
            $table->unsignedBigInteger('id_compra');
            $table->decimal('debe', 10, 2);
            $table->decimal('haber', 10, 2);
            $table->decimal('saldo', 10, 2);
            $table->string('descripcion', 200);
            $table->integer('estado')->default(1);
            $table->timestamps();

            $table->foreign('id_compra')->references('id')->on('compra');
            $table->foreign('id_proveedor')->references('id')->on('proveedor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deuda_proveedor');
    }
};
