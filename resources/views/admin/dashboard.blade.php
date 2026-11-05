<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Administrador - WorkSpace Hub') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-brand-DEFAULT">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold text-brand-dark mb-4">🏠 Gestión de Espacios y Reservas</h3>
                    <div class="flex gap-4 mb-6">
                        <button class="px-4 py-2 bg-brand-DEFAULT text-white rounded hover:bg-brand-dark">Publicar Nuevo Espacio</button>
                        <button class="px-4 py-2 border border-brand-DEFAULT text-brand-DEFAULT rounded hover:bg-brand-light">Ver Reportes de Pago</button>
                    </div>

                    <h4 class="font-semibold mb-2">Últimas Reservas en el Sistema</h4>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Usuario</th>
                                <th class="border p-2">Espacio</th>
                                <th class="border p-2">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border p-2">Juan Pérez</td>
                                <td class="border p-2">Oficina Privada A</td>
                                <td class="border p-2 text-green-600">Confirmada</td>
                            </tr>
                            <tr>
                                <td class="border p-2">María Gómez</td>
                                <td class="border p-2">Sala de Juntas 1</td>
                                <td class="border p-2 text-yellow-600">Pendiente</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>