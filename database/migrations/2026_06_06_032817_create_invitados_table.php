<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invitados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_familia');
            // Hacemos el token nullable para evitar bloqueos SQL en inserciones directas
            $table->string('token', 16)->unique()->nullable(); 
            $table->integer('cupos_confirmados')->nullable();
            $table->string('nombres_asistentes')->nullable(); // Asegurar que exista el campo para los nombres detallados
            $table->boolean('asistira')->nullable(); 
            $table->text('mensaje_novios')->nullable();
            $table->timestamp('confirmado_el')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invitados');
    }
};