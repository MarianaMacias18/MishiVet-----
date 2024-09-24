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
            $table->string('name',60); 
            $table->string('apellidoP', 50);
            $table->string('apellidoM', 50); 
            $table->string('email')->unique(); #Correo único en la BD
            $table->string('password');
            $table->string('telefono');
            $table->text('direccion'); #65,535 Caracteres
            $table->rememberToken();
            $table->timestamps(); 
            $table->softDeletes();  // Añade el campo deleted_at
            #$table->timestamp('email_verified_at')->nullable();
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
