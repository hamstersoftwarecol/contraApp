<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center shadow-sm">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h2 class="font-bold text-lg text-gray-800">
                    Información del Pago #{{ $payment->id }}
                </h2>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('payments.edit', $payment) }}" class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Editar
                </a>
                <a href="{{ route('payments.index') }}" class="inline-flex items-center px-3 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Payment Status Banner -->
            <div class="mb-6">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-green-800">Pago Registrado</h3>
                            <p class="text-xs text-green-600">Este pago ha sido procesado exitosamente el {{ $payment->fecha_pago->format('d/m/Y') }}</p>
                        </div>
                        <div class="ml-auto">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                ${{ number_format($payment->monto, 0) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Payment Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-5 py-3">
                        <h3 class="text-base font-semibold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Detalles del Pago
                        </h3>
                    </div>
                    <div class="p-5">
                        <dl class="space-y-4">
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-600 flex items-center">
                                    <div class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center mr-2">
                                        <span class="text-xs font-bold text-blue-600">#</span>
                                    </div>
                                    ID del Pago
                                </dt>
                                <dd class="text-sm font-semibold text-gray-900">#{{ $payment->id }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-600 flex items-center">
                                    <div class="w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center mr-2">
                                        <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                    </div>
                                    Monto
                                </dt>
                                <dd class="text-sm font-bold text-gray-900">${{ number_format($payment->monto, 0) }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-600 flex items-center">
                                    <div class="w-6 h-6 bg-purple-100 rounded-lg flex items-center justify-center mr-2">
                                        <svg class="w-3 h-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 8a2 2 0 100-4 2 2 0 000 4zm0 0v4a2 2 0 002 2h6a2 2 0 002-2v-4a2 2 0 00-2-2h-6a2 2 0 00-2 2z"></path>
                                        </svg>
                                    </div>
                                    Fecha de Pago
                                </dt>
                                <dd class="text-sm font-semibold text-gray-900">{{ $payment->fecha_pago->format('d/m/Y') }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-600 flex items-center">
                                    <div class="w-6 h-6 bg-indigo-100 rounded-lg flex items-center justify-center mr-2">
                                        <svg class="w-3 h-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                    </div>
                                    Método de Pago
                                </dt>
                                <dd>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $payment->metodo_pago === 'efectivo' ? 'bg-green-100 text-green-800' : ($payment->metodo_pago === 'transferencia' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                                        {{ ucfirst($payment->metodo_pago) }}
                                    </span>
                                </dd>
                            </div>
                            @if($payment->referencia)
                                <div class="flex items-center justify-between py-2">
                                    <dt class="text-sm font-medium text-gray-600 flex items-center">
                                        <div class="w-6 h-6 bg-gray-100 rounded-lg flex items-center justify-center mr-2">
                                            <svg class="w-3 h-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                        </div>
                                        Referencia
                                    </dt>
                                    <dd class="text-sm font-semibold text-gray-900">{{ $payment->referencia }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                </div>

                <!-- Contract Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-5 py-3">
                        <h3 class="text-base font-semibold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Información del Contrato
                        </h3>
                    </div>
                    <div class="p-5">
                        <dl class="space-y-4">
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-600 flex items-center">
                                    <div class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center mr-2">
                                        <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    Cliente
                                </dt>
                                <dd>
                                    <a href="{{ route('clients.show', $payment->contract->client) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                        {{ $payment->contract->client->nombre_completo }}
                                    </a>
                                </dd>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-600 flex items-center">
                                    <div class="w-6 h-6 bg-purple-100 rounded-lg flex items-center justify-center mr-2">
                                        <svg class="w-3 h-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                        </svg>
                                    </div>
                                    Cédula
                                </dt>
                                <dd class="text-sm font-semibold text-gray-900">{{ $payment->contract->client->cedula }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-600 flex items-center">
                                    <div class="w-6 h-6 bg-indigo-100 rounded-lg flex items-center justify-center mr-2">
                                        <span class="text-xs font-bold text-indigo-600">#</span>
                                    </div>
                                    ID del Contrato
                                </dt>
                                <dd>
                                    <a href="{{ route('contracts.show', $payment->contract) }}" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                        #{{ $payment->contract->id }}
                                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-1M10 6V5a2 2 0 112 0v1M10 6h4"></path>
                                        </svg>
                                    </a>
                                </dd>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-600 flex items-center">
                                    <div class="w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center mr-2">
                                        <span class="text-xs font-bold text-green-600">{{ $payment->numero_cuota }}</span>
                                    </div>
                                    Número de Cuota
                                </dt>
                                <dd class="text-sm font-semibold text-gray-900">{{ $payment->numero_cuota }} de {{ $payment->contract->numero_cuotas }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-600 flex items-center">
                                    <div class="w-6 h-6 bg-emerald-100 rounded-lg flex items-center justify-center mr-2">
                                        <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                    </div>
                                    Monto Total
                                </dt>
                                <dd class="text-sm font-bold text-gray-900">${{ number_format($payment->contract->monto_total, 0) }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-2">
                                <dt class="text-sm font-medium text-gray-600 flex items-center">
                                    <div class="w-6 h-6 bg-orange-100 rounded-lg flex items-center justify-center mr-2">
                                        <svg class="w-3 h-3 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    Monto Pendiente
                                </dt>
                                <dd class="text-sm font-bold text-orange-600">${{ number_format($payment->contract->monto_pendiente, 0) }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            @if($payment->notas)
                <div class="mt-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-amber-500 to-orange-600 px-5 py-3">
                            <h3 class="text-base font-semibold text-white flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Notas del Pago
                            </h3>
                        </div>
                        <div class="p-5">
                            <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                                <p class="text-sm text-gray-700 whitespace-pre-line leading-relaxed">{{ $payment->notas }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="mt-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-500 to-gray-600 px-5 py-3">
                        <h3 class="text-base font-semibold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Información del Sistema
                        </h3>
                    </div>
                    <div class="p-5">
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-600 flex items-center">
                                    <div class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center mr-2">
                                        <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                    Creado
                                </dt>
                                <dd class="text-sm font-semibold text-gray-900">{{ $payment->created_at->format('d/m/Y H:i') }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-600 flex items-center">
                                    <div class="w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center mr-2">
                                        <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                    </div>
                                    Última Actualización
                                </dt>
                                <dd class="text-sm font-semibold text-gray-900">{{ $payment->updated_at->format('d/m/Y H:i') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>