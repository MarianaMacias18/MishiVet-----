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
        Schema::create('adoption_user_kittens', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_adopcion'); 
            $table->string('ubicacion_refugio'); 
            
            $table->foreignId('id_refugio')->constrained('shelters')->onDelete('cascade'); // FK a la tabla shelters
            $table->foreignId('id_usuario_adoptivo')->constrained('users')->onDelete('cascade'); // FK a la tabla users
            $table->foreignId('id_gato')->constrained('kittens')->onDelete('cascade'); // FK a la tabla kittens
            $table->timestamps();
            $table->softDeletes();  // Añade el campo deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoption_user_kittens');
    }
};
