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
        Schema::create('imagen_prevs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invitacion_id');
            $table->foreign('invitacion_id')->references('id')->on('invitacions')->onDelete('cascade');
            $table->string('ruta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagen_prevs');
    }
};
