<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('correo')->nullable();
            $table->integer('telefono');
            $table->string('direccion')->nullable();
            $table->integer('numero_documento');
            $table->unsignedBigInteger('tipo_documento_id');
            $table->timestamps();
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documentos')
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
        Schema::dropIfExists('clientes');
    }
}
