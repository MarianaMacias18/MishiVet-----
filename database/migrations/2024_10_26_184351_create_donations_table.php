<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id(); 
            $table->decimal('amount', 10, 2); // Cantidad donada
            $table->date('date'); // Fecha de la donación
            $table->string('numero_tarjeta'); // Número de tarjeta del donante
            $table->string('token'); // Token de pago
            $table->string('payment_method'); // Método de pago (e.g., 'tarjeta', 'PayPal', etc.)
            
            $table->foreignId('id_usuario_beneficiario')->constrained('users')->onDelete('cascade'); // FK de usuario_beneficiario
            $table->foreignId('id_refugio_beneficiario')->constrained('shelters')->onDelete('cascade'); // FK refugio_beneficiario
            $table->foreignId('id_usuario_donador')->constrained('users')->onDelete('cascade'); // FK_usuario_donante
            $table->timestamps(); // Campos de marca de tiempo (created_at, updated_at)
        });
    }

    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
