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
        Schema::create('multimedia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bloque_id'); // Relación con la tabla invitacions
            $table->string('tipo', 50); // Tipo de multimedia (ej: imagen, video)
            $table->string('ruta'); // Ruta del archivo multimedia
            $table->boolean('galeria')->default(false); // Indica si pertenece a la galería
            $table->timestamps();

            // Relación con invitacions
            $table->foreign('bloque_id')->references('id')->on('bloques')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multimedia');
    }
};
