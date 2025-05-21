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
        Schema::create('invitados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo', 100);
            $table->boolean('asistencia')->default(false);

            $table->unsignedBigInteger('invitacion_id');
            $table->string('email')->unique()->nullable();
            $table->integer('celular')->nullable();
            $table->timestamps();

            $table->foreign('invitacion_id')->references('id')->on('invitacions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitados');
    }
};
