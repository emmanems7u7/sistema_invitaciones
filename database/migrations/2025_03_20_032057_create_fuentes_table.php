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
        Schema::create('fuentes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invitacion_id'); // Relación con la tabla invitaciones
            $table->foreign('invitacion_id')->references('id')->on('invitacions')->onDelete('cascade');

            $table->string('tipo');
            $table->string('fuente'); // Fuente a utilizar para el tipo de letra
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuentes');
    }
};
