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
    Schema::create('reservas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('espacio_id')->constrained('espacios')->onDelete('cascade');
        $table->date('fecha');
        $table->time('hora_inicio');
        $table->time('hora_fin');
        $table->decimal('total', 8, 2);
        $table->string('estado')->default('Confirmada'); // Confirmado, Cancelado y Pendiente
        $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
