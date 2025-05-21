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
        Schema::create('textos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['Titulo', 'Subtitulo', 'Parrafo']);
            $table->text('contenido');
            $table->unsignedBigInteger('bloque_id');
            $table->timestamps();

            // Relación
            $table->foreign('bloque_id')->references('id')->on('bloques')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('textos');
    }
};
