<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cronogramas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invitacion_id'); // Relación con la tabla invitacions
            $table->time('hora'); // Hora de la actividad
            $table->string('actividad'); // Descripción de la actividad
            $table->string('icono')->nullable(); // Icono representativo (puede ser una URL o clase CSS)
            $table->timestamps();


            $table->foreign('invitacion_id')->references('id')->on('invitacions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cronogramas');
    }
};
