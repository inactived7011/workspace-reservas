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
    Schema::create('espacios', function (Blueprint $table) {
        $table->id();
        $table->string('nombre'); // Ejm: Escritorio Compartido Nr4, Sala de Juntas 1
        $table->string('tipo'); // Escritorio, Sala de Reuniones, Oficina Privada
        $table->string('ubicacion'); // Ej:Jr. Dos de Mayo 450, Centro
        $table->decimal('precio_hora', 8, 2);
        $table->integer('capacidad');
        $table->text('descripcion')->nullable();
        $table->boolean('disponible')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('espacios');
    }
};
