<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalle del Contrato') }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('contracts.edit', $contract) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Editar Contrato
                </a>
                <a href="{{ route('contracts.pdf', $contract) }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Descargar PDF
                </a>
                @if($contract->estado === 'activo')
                    <a href="{{ route('payments.create') }}?contract_id={{ $contract->id }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Registrar Pago
                    </a>
                @endif
                @if(!$contract->firma)
                    <a href="{{ route('contracts.firmar', $contract) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Firmar Contrato
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Información del Contrato</h3>
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Cliente</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <a href="{{ route('clients.show', $contract->client) }}" class="text-indigo-600 hover:text-indigo-900">
                                            {{ $contract->client->nombre_completo }}
                                        </a>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Monto Total</dt>
                                    <dd class="mt-1 text-sm text-gray-900">${{ number_format($contract->monto_total, 2) }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Monto por Cuota</dt>
                                    <dd class="mt-1 text-sm text-gray-900">${{ number_format($contract->monto_cuota, 2) }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Fecha de Inicio</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $contract->fecha_inicio->format('d/m/Y') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Estado</dt>
                                    <dd class="mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $contract->estado === 'completado' ? 'bg-green-100 text-green-800' : 
                                               ($contract->estado === 'activo' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($contract->estado) }}
                                        </span>
                                    </dd>
                                </div>
                                @if($contract->descripcion)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Descripción</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $contract->descripcion }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Resumen de Pagos</h3>
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Cuotas Pagadas</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $contract->cuotas_pagadas }} de {{ $contract->numero_cuotas }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Monto Pagado</dt>
                                    <dd class="mt-1 text-sm text-gray-900">${{ number_format($contract->monto_pagado, 2) }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Monto Pendiente</dt>
                                    <dd class="mt-1 text-sm text-gray-900">${{ number_format($contract->monto_pendiente, 2) }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Cuotas Pendientes</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $contract->cuotas_pendientes }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Historial de Pagos</h3>
                        @if($contract->payments->isNotEmpty())
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cuota</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monto</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Método</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Referencia</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($contract->payments as $payment)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $payment->numero_cuota }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $payment->fecha_pago->format('d/m/Y') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">${{ number_format($payment->monto, 2) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $payment->metodo_pago ?? 'N/A' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $payment->referencia_pago ?? 'N/A' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <a href="{{ route('payments.show', $payment) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Ver</a>
                                                    <a href="{{ route('payments.edit', $payment) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">Editar</a>
                                                    <form action="{{ route('payments.destroy', $payment) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Está seguro de eliminar este pago?')">
                                                            Eliminar
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500 italic">No hay pagos registrados para este contrato.</p>
                        @endif
                    </div>

                    @if($contract->firma)
                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Firma del Contratante</h3>
                            <img src="{{ $contract->firma }}" alt="Firma del cliente" style="max-width: 300px; border: 1px solid #ccc; background: #fff; padding: 8px;">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 