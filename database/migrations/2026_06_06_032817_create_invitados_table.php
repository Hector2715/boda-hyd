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
            $table->string('token', 16)->unique(); // El hash único para la URL
            $table->integer('cupos_max');
            $table->integer('cupos_confirmados')->nullable();
            $table->boolean('asistira')->nullable(); // null = sin responder
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
