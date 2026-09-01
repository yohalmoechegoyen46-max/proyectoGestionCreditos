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
        Schema::create('creditos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clientes_id')->constrained('clientes')->onDelete('cascade');
            $table->date('fecha_otorgamiento');
            $table->date('fecha_vencimiento');
            $table->decimal('monto', 10 , 2);
            $table->decimal('tasa_interes', 10 , 2);
            $table->integer('plazo'); 
            $table->decimal('total_credito', 10 , 2);
            $table->decimal('saldo', 10 , 2);
            $table->string('estado', 50)->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creditos');
    }
};