<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shelters_events', function (Blueprint $table) {
            $table->id(); // ID de la tabla pivote
            $table->foreignId('id_refugio')->constrained('shelters')->onDelete('cascade'); // FK a la tabla shelters
            $table->foreignId('id_evento')->constrained('events')->onDelete('cascade'); // FK a la tabla events
            
            // Campos adicionales para la tabla pivote
            $table->string('ubicacion')->default('GDL'); // Ubicación del evento
            $table->integer('participantes'); // Número de participantes
            $table->timestamps(); // Campos de marca de tiempo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shelters_events');
    }
};
