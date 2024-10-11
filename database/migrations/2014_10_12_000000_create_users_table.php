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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60); 
            $table->string('apellidoP', 50)->nullable();
            $table->string('apellidoM', 50)->nullable(); 
            $table->string('email')->unique(); // Correo único en la BD
            $table->string('password')->nullable(); // Puede ser nulo ya que este campo no es necesario para usuarios autenticados por GitHub
            $table->string('telefono')->nullable();
            $table->text('direccion')->nullable(); // 65,535 caracteres
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable(); 
            $table->string('email_verification_hash')->nullable(); // Columna para el hash de verificación de correo
            $table->string('github_id')->unique()->nullable(); // ID de GitHub
            $table->string('avatar')->nullable(); // Avatar del usuario
            $table->timestamps(); 
            $table->softDeletes(); // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
