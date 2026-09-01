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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('documento_identidad');
            $table->string('telefono');
            $table->string('correo')->unique();
            $table->string('direccion');
            $table->enum('estado',['activo','inactivo'])->defualt('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }

    // Relación de uno a muchos: Un cliente posee muchos créditos
    public function creditos()
        {
            return $this->hasMany(creditos::class, 'id_cliente');
        }
};