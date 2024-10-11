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
            $table->string('apellidoP', 50);
            $table->string('apellidoM', 50); 
            $table->string('email')->unique(); // Correo único en la BD
            $table->string('password');
            $table->string('telefono');
            $table->text('direccion'); // 65,535 caracteres
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable(); 
            $table->string('email_verification_hash')->nullable(); // Columna para el hash de verificación de correo
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
