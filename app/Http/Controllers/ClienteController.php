<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Espacio;
use App\Models\Reserva;
use Carbon\Carbon;

class ClienteController extends Controller
{
    
     //Muestra el catálogo de espacios y las reservas activas del cliente.
     
    public function index(Request $request)
    {
        $user = Auth::user();

        // Control de acceso por rol
        if ($user->email === 'admin@admin.com') {
            abort(403, 'ACCESO DENEGADO: Área exclusiva para clientes.');
        }

        // Funcionalidad 1
        // Consultas y filtrado de espacios disponibles
        $query = Espacio::where('disponible', true);

        if ($request->filled('buscar')) {
            $termino = $request->input('buscar');
            $query->where(function ($q) use ($termino) {
                $q->where('nombre', 'like', "%{$termino}%")
                  ->orWhere('ubicacion', 'like', "%{$termino}%")
                  ->orWhere('tipo', 'like', "%{$termino}%");
            });
        }

        if ($request->filled('tipo') && $request->input('tipo') !== 'Todos') {
            $query->where('tipo', $request->input('tipo'));
        }

        $espacios = $query->orderBy('precio_hora', 'asc')->get();

        // Historial real de reservas del usuario autenticado
        $misReservas = Reserva::with('espacio')
            ->where('user_id', $user->id)
            ->orderBy('fecha', 'desc')
            ->orderBy('hora_inicio', 'desc')
            ->get();

        return view('cliente.dashboard', compact('espacios', 'misReservas'));
    }

    
     //Funcionalidad 2: Valida y registra una nueva reserva en la base de datos.
     
    public function storeReserva(Request $request)
    {
        // Validación estricta con mensajes personalizados
        $validated = $request->validate([
            'espacio_id' => 'required|exists:espacios,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        ], [
            'espacio_id.required' => 'Debe seleccionar un espacio de trabajo.',
            'espacio_id.exists' => 'El espacio seleccionado no es válido.',
            'fecha.required' => 'La fecha de reserva es obligatoria.',
            'fecha.after_or_equal' => 'La fecha no puede ser anterior a hoy.',
            'hora_inicio.required' => 'Indique la hora de inicio.',
            'hora_fin.required' => 'Indique la hora de finalización.',
            'hora_fin.after' => 'La hora de fin debe ser posterior a la hora de inicio.',
        ]);

        $espacio = Espacio::findOrFail($validated['espacio_id']);

        // Cálculo de horas y precio total
        $inicio = Carbon::createFromFormat('H:i', $validated['hora_inicio']);
        $fin = Carbon::createFromFormat('H:i', $validated['hora_fin']);
        $duracionHoras = max(1, $inicio->diffInHours($fin));
        $total = $duracionHoras * $espacio->precio_hora;

        // Persistencia en base de datos
        Reserva::create([
            'user_id' => Auth::id(),
            'espacio_id' => $espacio->id,
            'fecha' => $validated['fecha'],
            'hora_inicio' => $validated['hora_inicio'],
            'hora_fin' => $validated['hora_fin'],
            'total' => $total,
            'estado' => 'Confirmada',
        ]);

        return redirect()->route('cliente.dashboard')
            ->with('success', "¡Reserva confirmada con éxito para '{$espacio->nombre}'!");
    }

    /* Permite cancelar una reserva existente.*/
    public function cancelReserva($id)
    {
        $reserva = Reserva::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $reserva->update(['estado' => 'Cancelada']);

        return redirect()->route('cliente.dashboard')
            ->with('info', 'La reserva ha sido cancelada correctamente.');
    }
}