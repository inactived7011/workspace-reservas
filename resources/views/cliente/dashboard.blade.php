<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Cliente - WorkSpace Hub') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-brand-DEFAULT">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold text-brand-DEFAULT mb-4">👤 Mis Reservas de Trabajo</h3>
                    
                    <!-- Formulario de Búsqueda Simulado -->
                    <div class="mb-8 p-4 bg-brand-light rounded">
                        <h4 class="font-semibold mb-2 text-brand-dark">Buscar Espacio Disponible</h4>
                        <form action="#" method="GET" class="flex gap-4">
                            @csrf
                            <input type="text" placeholder="Ubicación (Ej. Centro)" class="border p-2 rounded w-full">
                            <select class="border p-2 rounded w-full">
                                <option>Escritorio Compartido</option>
                                <option>Sala de Reuniones</option>
                                <option>Oficina Privada</option>
                            </select>
                            <button type="button" class="px-4 py-2 bg-brand-DEFAULT text-white rounded hover:bg-brand-dark">Buscar</button>
                        </form>
                    </div>

                    <h4 class="font-semibold mb-2">Mis Próximas Reservas</h4>
                    <div class="border p-4 rounded bg-gray-50 mb-4 border-l-4 border-brand-DEFAULT">
                        <p><strong>Espacio:</strong> Escritorio Compartido #4</p>
                        <p><strong>Fecha:</strong> 10 de Noviembre, 2026</p>
                        <p><strong>Hora:</strong> 09:00 AM - 12:00 PM</p>
                        <p class="mt-2 text-green-600 font-bold">Estado: Pagado</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>