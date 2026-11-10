<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Espacio;

class EspacioSeeder extends Seeder
{
    public function run(): void
    {
        $espacios = [
            [
                'nombre' => 'Escritorio Flex #1',
                'tipo' => 'Escritorio Compartido',
                'ubicacion' => 'Piso 1 - Zona Coworking Centro',
                'precio_hora' => 10.00,
                'capacidad' => 1,
                'descripcion' => 'Puesto individual con conexión eléctrica directa y silla ergonómica.',
                'disponible' => true,
            ],
            [
                'nombre' => 'Escritorio Dedicado #4',
                'tipo' => 'Escritorio Compartido',
                'ubicacion' => 'Piso 1 - Zona Coworking Centro',
                'precio_hora' => 15.00,
                'capacidad' => 1,
                'descripcion' => 'Espacio de trabajo silencioso con gaveta bajo llave y monitor secundario.',
                'disponible' => true,
            ],
            [
                'nombre' => 'Sala de Innovación A',
                'tipo' => 'Sala de Reuniones',
                'ubicacion' => 'Piso 2 - Sala de Juntas',
                'precio_hora' => 45.00,
                'capacidad' => 6,
                'descripcion' => 'Pizarra acrílica, proyector HDMI y aire acondicionado.',
                'disponible' => true,
            ],
            [
                'nombre' => 'Oficina Ejecutiva Privada',
                'tipo' => 'Oficina Privada',
                'ubicacion' => 'Piso 3 - Área Privada',
                'precio_hora' => 60.00,
                'capacidad' => 3,
                'descripcion' => 'Oficina cerrada acústicamente con vista panorámica y mesa para reuniones pequeñas.',
                'disponible' => true,
            ],
        ];

        foreach ($espacios as $espacio) {
            Espacio::create($espacio);
        }
    }
}