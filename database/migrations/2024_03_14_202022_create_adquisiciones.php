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
        Schema::create('adquisiciones', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->decimal('presupuesto', 10, 2);
            $table->integer('cantidad');
            $table->decimal('valor_unitario', 10, 2);
            $table->decimal('valor_total', 10, 2);
            $table->date('fecha_adquisicion');
            $table->text('documentacion')->nullable();
            $table->bigInteger('unidad_id')->unsigned();
            $table->foreign('unidad_id')->references('id')->on('unidades');
            $table->bigInteger('tipo_id')->unsigned();
            $table->foreign('tipo_id')->references('id')->on('tipos');
            $table->bigInteger('proveedor_id')->unsigned();
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adquisicion');
    }
};
