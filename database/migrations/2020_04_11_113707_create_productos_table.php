<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('nombre', 200);
            $table->string('descripcion', 100)->nullable();
            $table->integer('stock');
            $table->integer('precio_compra');
            $table->integer('precio_venta');
            $table->integer('ganancia')->unsigned();
            $table->string('moneda', 3);
            $table->unsignedBigInteger('categoria_id');
            $table->timestamps();
            $table->foreign('categoria_id')->references('id')->on('categorias')
            ->onDelete('restrict')
            ->onDelete('restrict');
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
        Schema::drop('productos');
    }
}
