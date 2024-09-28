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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notificable_id'); // ID del usuario o refugio
            $table->string('notificable_type'); // Tipo de entidad (User o Shelter)
            
            $table->dateTime('fecha'); 
            $table->enum('estado_notificacion', ['aceptada', 'pendiente', 'rechazada']); // Estado de la notificación
            
            $table->foreignId('id_gato')->constrained('kittens')->onDelete('cascade'); // FK a la tabla kittens
            $table->foreignId('id_usuario_solicitante')->constrained('users')->onDelete('cascade'); // FK a la tabla users
            $table->timestamps();
            $table->softDeletes();  // Añade el campo deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
