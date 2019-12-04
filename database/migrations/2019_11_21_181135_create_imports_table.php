<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lote');
            $table->date('fecha_entrada');
            $table->string('detalle');
            $table->string('nro_contable');
            $table->string('ubicacion');
            $table->float('cantidad_stock');
            $table->string('salida');
            $table->float('cantidad_salida');
            $table->string('correo');
            $table->string('observacion');
            $table->timestamps('created_at');
            $table->timestamps('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imports');
    }
}
