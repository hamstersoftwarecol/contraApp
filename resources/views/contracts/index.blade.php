<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-purple-50 to-indigo-100 dark:from-gray-900 dark:via-purple-900 dark:to-indigo-900 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Compact Header -->
            <div class="mb-6">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">
                                Gestión de Contratos
                            </h1>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                Administra todos los contratos del sistema
                            </p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="text-right">
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Total contratos</p>
                                <p class="text-xl font-bold text-purple-600 dark:text-purple-400">{{ $contracts->total() }}</p>
                            </div>
                            <a href="{{ route('contracts.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Crear Contrato
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4">
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-lg p-3">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-green-600 dark:text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Compact Contracts Table -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 dark:from-purple-900/20 dark:to-indigo-900/20 px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Lista de Contratos</h3>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300 border border-purple-200 dark:border-purple-700">
                            {{ $contracts->count() }} de {{ $contracts->total() }} registros
                        </span>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700">
                        <thead class="bg-gray-50/50 dark:bg-gray-900/30">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                        </svg>
                                        <span>ID</span>
                                    </div>
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span>Cliente</span>
                                    </div>
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                        <span>Monto</span>
                                    </div>
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                        <span>Progreso</span>
                                    </div>
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>Estado</span>
                                    </div>
                                </th>
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    <span>Acciones</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-50 dark:divide-gray-700/50">
                            @forelse($contracts as $contract)
                                <tr class="hover:bg-purple-50/50 dark:hover:bg-purple-900/10 transition-all duration-200">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-2">
                                                <span class="text-xs font-bold text-purple-600 dark:text-purple-400">#{{ $contract->id }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-lg flex items-center justify-center mr-3 shadow-sm">
                                                <span class="text-white font-bold text-sm">{{ strtoupper(substr($contract->client->nombre, 0, 1)) }}{{ strtoupper(substr($contract->client->apellido, 0, 1)) }}</span>
                                            </div>
                                            <div>
                                                <a href="{{ route('clients.show', $contract->client) }}" class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-300">
                                                    {{ $contract->client->nombre_completo }}
                                                </a>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $contract->client->cedula }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            ${{ number_format($contract->monto_total, 0) }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            Pendiente: ${{ number_format($contract->monto_pendiente, 0) }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mr-2">
                                                <div class="bg-gradient-to-r from-purple-500 to-indigo-600 h-2 rounded-full"
                                                     style="width: {{ $contract->numero_cuotas > 0 ? ($contract->cuotas_pagadas / $contract->numero_cuotas) * 100 : 0 }}%"></div>
                                            </div>
                                            <span class="text-xs font-medium text-gray-600 dark:text-gray-300 whitespace-nowrap">
                                                {{ $contract->cuotas_pagadas }}/{{ $contract->numero_cuotas }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold border
                                            {{ $contract->estado === 'completado' ? 'bg-green-100 text-green-800 border-green-200 dark:bg-green-900/30 dark:text-green-300 dark:border-green-700' :
                                               ($contract->estado === 'activo' ? 'bg-blue-100 text-blue-800 border-blue-200 dark:bg-blue-900/30 dark:text-blue-300 dark:border-blue-700' : 'bg-red-100 text-red-800 border-red-200 dark:bg-red-900/30 dark:text-red-300 dark:border-red-700') }}">
                                            {{ ucfirst($contract->estado) }}
                                        </span>
                                        @if($contract->estado_formateado['dias'])
                                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                {{ $contract->estado_formateado['dias'] }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-center space-x-1">
                                            <a href="{{ route('contracts.show', $contract) }}"
                                               class="inline-flex items-center px-2 py-1 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/30 dark:hover:bg-blue-800/50 text-blue-700 dark:text-blue-300 rounded text-xs transition-colors duration-200"
                                               title="Ver contrato">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('contracts.edit', $contract) }}"
                                               class="inline-flex items-center px-2 py-1 bg-amber-100 hover:bg-amber-200 dark:bg-amber-900/30 dark:hover:bg-amber-800/50 text-amber-700 dark:text-amber-300 rounded text-xs transition-colors duration-200"
                                               title="Editar contrato">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('contracts.pdf', $contract) }}"
                                               class="inline-flex items-center px-2 py-1 bg-red-100 hover:bg-red-200 dark:bg-red-900/30 dark:hover:bg-red-800/50 text-red-700 dark:text-red-300 rounded text-xs transition-colors duration-200"
                                               title="Descargar PDF">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            </a>
                                            @if($contract->estado === 'activo')
                                                <a href="{{ route('payments.create') }}?contract_id={{ $contract->id }}"
                                                   class="inline-flex items-center px-2 py-1 bg-green-100 hover:bg-green-200 dark:bg-green-900/30 dark:hover:bg-green-800/50 text-green-700 dark:text-green-300 rounded text-xs transition-colors duration-200"
                                                   title="Registrar pago">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                </a>
                                            @endif
                                            <button type="button"
                                                    onclick="confirmDelete('{{ $contract->id }}')"
                                                    class="inline-flex items-center px-2 py-1 bg-red-100 hover:bg-red-200 dark:bg-red-900/30 dark:hover:bg-red-800/50 text-red-700 dark:text-red-300 rounded text-xs transition-colors duration-200"
                                                    title="Eliminar contrato">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                            <form id="delete-form-{{ $contract->id }}"
                                                  action="{{ route('contracts.destroy', $contract) }}"
                                                  method="POST"
                                                  class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-3">
                                                <svg class="w-6 h-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            </div>
                                            <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-1">No hay contratos registrados</h3>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">Comienza creando tu primer contrato</p>
                                            <a href="{{ route('contracts.create') }}"
                                               class="inline-flex items-center px-3 py-2 bg-purple-600 hover:bg-purple-700 text-white text-xs font-medium rounded-lg transition-colors duration-200">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                Crear primer contrato
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Compact Pagination -->
                <div class="bg-gray-50 dark:bg-gray-900/30 px-6 py-3 border-t border-gray-100 dark:border-gray-700">
                    {{ $contracts->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Verificar contratos por vencer y atrasados
            const contratos = {!! json_encode($contracts->map(function($contract) {
                return [
                    'id' => $contract->id,
                    'cliente' => $contract->client->nombre_completo,
                    'esta_por_vencer' => $contract->esta_por_vencer,
                    'esta_atrasado' => $contract->esta_atrasado,
                    'dias_atraso' => $contract->dias_atraso,
                    'dias_para_vencer' => $contract->dias_para_vencer
                ];
            })) !!};

            // Mostrar notificaciones para contratos por vencer
            const contratosPorVencer = contratos.filter(c => c.esta_por_vencer);
            if (contratosPorVencer.length > 0) {
                let mensajePorVencer = '<div class="text-left">';
                contratosPorVencer.forEach(c => {
                    mensajePorVencer += `
                        <div class="mb-2">
                            <strong>${c.cliente}</strong>: Vence en ${c.dias_para_vencer} días
                        </div>`;
                });
                mensajePorVencer += '</div>';

                Swal.fire({
                    title: 'Contratos Próximos a Vencer',
                    html: mensajePorVencer,
                    icon: 'warning',
                    confirmButtonText: 'Entendido'
                });
            }

            // Mostrar notificaciones para contratos atrasados
            const contratosAtrasados = contratos.filter(c => c.esta_atrasado);
            if (contratosAtrasados.length > 0) {
                setTimeout(() => {
                    let mensajeAtrasados = '<div class="text-left">';
                    contratosAtrasados.forEach(c => {
                        mensajeAtrasados += `
                            <div class="mb-2">
                                <strong>${c.cliente}</strong>: ${c.dias_atraso} días de atraso
                            </div>`;
                    });
                    mensajeAtrasados += '</div>';

                    Swal.fire({
                        title: 'Contratos Atrasados',
                        html: mensajeAtrasados,
                        icon: 'error',
                        confirmButtonText: 'Entendido'
                    });
                }, contratosPorVencer.length > 0 ? 3000 : 0);
            }
        });

        // Función para confirmar eliminación
        function confirmDelete(contractId) {
            Swal.fire({
                title: '¿Está seguro?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${contractId}`).submit();
                }
            });
        }
    </script>
    @endpush
</x-app-layout> 