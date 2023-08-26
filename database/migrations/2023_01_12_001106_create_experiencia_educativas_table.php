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
        Schema::create('experiencia_educativas', function (Blueprint $table) {
            $table->id();
            //$table->integer('numMateria')->unique();
            $table->text('codMateria')->unique();;
            $table->integer('nrc')->unique()->nullable();
            $table->text('nombre');
            $table->integer('horas');
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
        Schema::dropIfExists('experiencia_educativas');
    }
};
