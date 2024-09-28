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
        Schema::create('shelters', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); 
            $table->string('direccion'); 
            $table->string('telefono'); 
            $table->string('correo')->unique(); // Correo del refugio
            $table->text('descripcion')->nullable(); 

            $table->foreignId('id_usuario_dueño')->constrained('users')->onDelete('cascade'); // FK al ID tabla users
            
            $table->timestamps();
            $table->softDeletes();  // Añade el campo deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shelters');
    }
};
