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
        Schema::table('ubicacions', function (Blueprint $table) {
            $table->string('icono')->nullable()->after('geolocalizacion'); // Añadir columna 'icono' después de 'geolocalizacion'
            $table->string('imagen')->nullable()->after('icono');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ubicacions', function (Blueprint $table) {
            $table->dropColumn(['icono', 'imagen']);
        });
    }
};
