<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Cliente - WorkSpace Hub') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Alertas de Éxito / Error -->
                    @if (session('success'))
                        <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 p-4 text-red-700 bg-red-100 rounded-lg">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h3 class="text-lg font-bold mb-4 text-[#075985]">Buscar Espacios de Trabajo</h3>

                    <!-- Formulario de Filtro -->
                    <form method="GET" action="{{ route('cliente.dashboard') }}" class="mb-8 bg-[#e0f2fe] p-4 rounded-lg flex gap-4 items-end">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700">Término de búsqueda</label>
                            <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Ej: Centro, Sala..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0284c7] focus:ring-[#0284c7]">
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700">Tipo de Espacio</label>
                            <select name="tipo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#0284c7] focus:ring-[#0284c7]">
                                <option value="Todos">Todos los tipos</option>
                                <option value="Escritorio Compartido" {{ request('tipo') == 'Escritorio Compartido' ? 'selected' : '' }}>Escritorio Compartido</option>
                                <option value="Sala de Reuniones" {{ request('tipo') == 'Sala de Reuniones' ? 'selected' : '' }}>Sala de Reuniones</option>
                                <option value="Oficina Privada" {{ request('tipo') == 'Oficina Privada' ? 'selected' : '' }}>Oficina Privada</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="bg-[#0284c7] hover:bg-[#075985] text-white font-bold py-2 px-4 rounded">
                                Filtrar
                            </button>
                        </div>
                    </form>

                    <!-- Listado de Espacios Disponibles -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                        @forelse($espacios as $espacio)
                            <div class="border rounded-lg p-4 shadow hover:shadow-md transition">
                                <h4 class="font-bold text-[#075985] text-lg">{{ $espacio->nombre }}</h4>
                                <p class="text-sm text-gray-600 mb-2">{{ $espacio->tipo }} - {{ $espacio->ubicacion }}</p>
                                <p class="text-gray-800 mb-4">{{ $espacio->descripcion }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-green-600">S/ {{ number_format($espacio->precio_hora, 2) }} / hr</span>
                                    <span class="text-xs bg-blue-100 text-blue-800 py-1 px-2 rounded">Cap: {{ $espacio->capacidad }} pax</span>
                                </div>
                                
                                <!-- Botón para abrir modal de reserva (Implementaremos el modal luego) -->
                                <button class="mt-4 w-full bg-[#0284c7] hover:bg-[#075985] text-white font-bold py-2 px-4 rounded text-sm">
                                    Reservar Ahora
                                </button>
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