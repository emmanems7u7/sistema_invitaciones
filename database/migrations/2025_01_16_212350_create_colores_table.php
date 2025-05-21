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
        Schema::create('colores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invitacion_id'); // Relación con la tabla invitacions
            $table->string('codigo', 7); // Código del color (por ejemplo, #FF5733)
            $table->string('tipo', 50); // Tipo de color (por ejemplo: fondo, texto)
            $table->timestamps();

            // Relación con invitacions
            $table->foreign('invitacion_id')->references('id')->on('invitacions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colores');
    }
};
