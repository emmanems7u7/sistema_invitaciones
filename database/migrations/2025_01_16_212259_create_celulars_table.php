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
        Schema::create('celulars', function (Blueprint $table) {
            $table->id();
            $table->string('celular', 20);
            $table->boolean('whatsapp')->default(false);
            $table->unsignedBigInteger('tipo_id');
            $table->string('tipo_type');
            $table->timestamps();


            $table->index(['tipo_id', 'tipo_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('celulars');
    }
};
