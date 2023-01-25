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
        //
        Schema::create('historico_consultas', function (Blueprint $table) {
            $table->id();
            $table->integer('idCiudad');
            $table->string('humedadConsultada')->nullable();
            $table->string('metodo')->nullable();
            $table->timestamp('fechaConsultada')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
