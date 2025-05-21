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
        Schema::create('componentes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->default();
            $table->string('tipo');
            $table->timestamps();
        });

        Schema::create('bloques', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', [
                'carrusel',
                'info_general',
                'info',
                'lista',
                'galeria',
                'galeria_2',
                'hora',
                'ubicacion',
            ]);
            $table->unsignedBigInteger('componente_id')->nullable();
            $table->foreign('componente_id')->references('id')->on('componentes')->onDelete('set null');

            $table->unsignedInteger('posicion')->default(1);
            $table->unsignedBigInteger('invitacion_id')->nullable();
            $table->foreign('invitacion_id')->references('id')->on('invitacions')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bloques');
    }
};
