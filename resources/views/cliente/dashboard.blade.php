<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Mensaje de Éxito -->
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Filtros de Búsqueda -->
                    <form method="GET" action="{{ route('cliente.dashboard') }}" class="mb-8 p-4 bg-gray-50 rounded-lg shadow-sm">
                        <div class="flex flex-col md:flex-row gap-4 items-end">
                            <div class="flex-1">
                                <x-input-label for="buscar" value="Buscar por ubicación o descripción" />
                                <x-text-input id="buscar" name="buscar" type="text" class="mt-1 block w-full" value="{{ request('buscar') }}" placeholder="Ej. Lima, Proyector..." />
                            </div>
                            <div class="flex-1">
                                <x-input-label for="tipo" value="Tipo de Espacio" />
                                <select id="tipo" name="tipo" class="mt-1 block w-full border-gray-300 focus:border-[#0284c7] focus:ring-[#0284c7] rounded-md shadow-sm">
                                    <option value="">Todos los tipos</option>
                                    <option value="Escritorio Compartido" {{ request('tipo') == 'Escritorio Compartido' ? 'selected' : '' }}>Escritorio Compartido</option>
                                    <option value="Oficina Privada" {{ request('tipo') == 'Oficina Privada' ? 'selected' : '' }}>Oficina Privada</option>
                                    <option value="Sala de Reuniones" {{ request('tipo') == 'Sala de Reuniones' ? 'selected' : '' }}>Sala de Reuniones</option>
                                </select>
                            </div>
                            <div>
                                <x-primary-button class="bg-[#0284c7] hover:bg-[#075985]">
                                    Filtrar
                                </x-primary-button>
                            </div>
                        </div>
                    </form>

                    <!-- Listado de Espacios Disponibles -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                        @forelse($espacios as $espacio)
                            <div class="border rounded-lg p-4 shadow hover:shadow-md transition">
                                <h4 class="font-bold text-[#075985] text-lg">{{ $espacio->nombre }}</h4>
                                <p class="text-sm text-gray-600 mb-2">{{ $espacio->tipo }} - {{ $espacio->ubicacion }}</p>
                                <p class="text-gray-800 mb-4">{{ $espacio->descripcion }}</p>
                                <div class="flex justify-between items-center mb-4">
                                    <span class="font-bold text-green-600">S/ {{ number_format($espacio->precio_hora, 2) }} / hr</span>
                                    <span class="text-xs bg-blue-100 text-blue-800 py-1 px-2 rounded">Cap: {{ $espacio->capacidad }} pax</span>
                                </div>
                                
                                <!-- Botón que abre el modal -->
                                <div x-data="{}">
                                    <button x-on:click.prevent="$dispatch('open-modal', 'reservar-espacio-{{ $espacio->id }}')" class="w-full bg-[#0284c7] hover:bg-[#075985] text-white font-bold py-2 px-4 rounded text-sm">
                                        Reservar Ahora
                                    </button>
                                </div>

                                <!-- Modal de Reserva exclusivo para este Espacio -->
                                <x-modal name="reservar-espacio-{{ $espacio->id }}" :show="$errors->any() && old('espacio_id') == $espacio->id" focusable>
                                    <form method="POST" action="{{ route('cliente.reservas.store') }}" class="p-6">
                                        @csrf
                                        <input type="hidden" name="espacio_id" value="{{ $espacio->id }}">

                                        <h2 class="text-lg font-medium text-gray-900 mb-4">
                                            Reservar: {{ $espacio->nombre }}
                                        </h2>

                                        <div class="mb-4">
                                            <x-input-label for="fecha_{{ $espacio->id }}" value="Fecha de Reserva" />
                                            <x-text-input id="fecha_{{ $espacio->id }}" name="fecha" type="date" class="mt-1 block w-full" value="{{ old('fecha') }}" />
                                            <x-input-error class="mt-2" :messages="$errors->get('fecha')" />
                                        </div>

                                        <div class="grid grid-cols-2 gap-4 mb-6">
                                            <div>
                                                <x-input-label for="hora_inicio_{{ $espacio->id }}" value="Hora Inicio (Ej: 09:00)" />
                                                <x-text-input id="hora_inicio_{{ $espacio->id }}" name="hora_inicio" type="time" class="mt-1 block w-full" value="{{ old('hora_inicio') }}" />
                                                <x-input-error class="mt-2" :messages="$errors->get('hora_inicio')" />
                                            </div>
                                            <div>
                                                <x-input-label for="hora_fin_{{ $espacio->id }}" value="Hora Fin (Ej: 13:00)" />
                                                <x-text-input id="hora_fin_{{ $espacio->id }}" name="hora_fin" type="time" class="mt-1 block w-full" value="{{ old('hora_fin') }}" />
                                                <x-input-error class="mt-2" :messages="$errors->get('hora_fin')" />
                                            </div>
                                        </div>

                                        <div class="mt-6 flex justify-end">
                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                Cancelar
                                            </x-secondary-button>

                                            <x-primary-button class="ml-3 bg-[#0284c7]">
                                                Confirmar Reserva
                                            </x-primary-button>
                                        </div>
                                    </form>
                                </x-modal>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-4 text-gray-500">
                                No se encontraron espacios disponibles con esos criterios.
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>