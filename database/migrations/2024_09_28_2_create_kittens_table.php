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
        Schema::create('kittens', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); 
            $table->string('raza');  
            $table->integer('edad');   
            $table->enum('sexo', ['macho', 'hembra']); 
            $table->string('color');  
            $table->text('detalles')->nullable(); 
            $table->string('foto')->nullable(); // Ruta de la foto
            $table->enum('estado', ['adoptado', 'apartado', 'libre']); // Estado del kitten

            $table->foreignId('id_refugio')->constrained('shelters')->onDelete('cascade'); // Referencia a la tabla shelters
            $table->foreignId('id_usuario_creador')->constrained('users')->onDelete('cascade'); //Usuario dueño/creador 

            $table->timestamps();
            $table->softDeletes();  // Añade el campo deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kittens');
    }
};
