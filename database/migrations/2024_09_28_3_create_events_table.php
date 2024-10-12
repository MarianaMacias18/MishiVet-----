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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario_dueño')->constrained('users')->onDelete('cascade'); // Asegúrate de que exista la relación
            $table->string('nombre'); 
            $table->dateTime('fecha'); 
            $table->text('descripcion'); 
            $table->timestamps();
            $table->softDeletes();  // campo deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
