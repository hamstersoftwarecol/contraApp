<x-app-layout>
    <!-- Fondo empresarial con gradiente sutil -->
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-gray-50 to-blue-50 dark:from-gray-900 dark:via-slate-900 dark:to-blue-900">
        <div class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header Section Mejorado -->
                <div class="mb-8">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-4xl font-bold text-gray-900 dark:text-white tracking-tight mb-2">
                                    Panel de Control Ejecutivo
                                </h1>
                                <p class="text-lg text-gray-600 dark:text-gray-300 font-medium">
                                    Resumen integral del sistema de gestión de pagos
                                </p>
                            </div>
                            <div class="hidden md:flex items-center space-x-6">
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Última actualización</p>
                                    <p class="text-lg font-bold text-gray-900 dark:text-white">{{ now()->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse shadow-lg"></div>
                                    <span class="text-sm font-semibold text-green-600 dark:text-green-400">En línea</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Estadísticas Principales Mejoradas -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Total Clientes -->
                    <div class="group relative bg-gradient-to-br from-white to-blue-50 dark:from-gray-800 dark:to-blue-900/20 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 border border-blue-100 dark:border-blue-800/50 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 via-transparent to-indigo-500/10"></div>
                        <div class="relative p-8">
                            <div class="flex items-start justify-between mb-6">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2 mb-3">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                        <p class="text-sm font-bold text-blue-700 dark:text-blue-300 uppercase tracking-wider">Total Clientes</p>
                                    </div>
                                    <p class="text-4xl font-black text-gray-900 dark:text-white mb-2">{{ number_format($estadisticas['totalClientes']) }}</p>
                                    <div class="flex items-center space-x-2">
                                        <div class="flex items-center px-2 py-1 bg-green-100 dark:bg-green-900/30 rounded-full">
                                            <svg class="w-3 h-3 text-green-600 dark:text-green-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-xs font-bold text-green-700 dark:text-green-300">+12%</span>
                                        </div>
                                        <span class="text-sm text-gray-600 dark:text-gray-300 font-medium">vs mes anterior</span>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full bg-blue-100 dark:bg-blue-900/30 rounded-full h-2">
                                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Contratos -->
                    <div class="group relative bg-gradient-to-br from-white to-emerald-50 dark:from-gray-800 dark:to-emerald-900/20 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 border border-emerald-100 dark:border-emerald-800/50 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 via-transparent to-green-500/10"></div>
                        <div class="relative p-8">
                            <div class="flex items-start justify-between mb-6">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2 mb-3">
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                                        <p class="text-sm font-bold text-emerald-700 dark:text-emerald-300 uppercase tracking-wider">Total Contratos</p>
                                    </div>
                                    <p class="text-4xl font-black text-gray-900 dark:text-white mb-2">{{ number_format($estadisticas['totalContratos']) }}</p>
                                    <div class="flex items-center space-x-2">
                                        <div class="flex items-center px-2 py-1 bg-green-100 dark:bg-green-900/30 rounded-full">
                                            <svg class="w-3 h-3 text-green-600 dark:text-green-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-xs font-bold text-green-700 dark:text-green-300">+8%</span>
                                        </div>
                                        <span class="text-sm text-gray-600 dark:text-gray-300 font-medium">vs mes anterior</span>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full bg-emerald-100 dark:bg-emerald-900/30 rounded-full h-2">
                                <div class="bg-gradient-to-r from-emerald-500 to-green-600 h-2 rounded-full" style="width: 92%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Pagos -->
                    <div class="group relative bg-gradient-to-br from-white to-purple-50 dark:from-gray-800 dark:to-purple-900/20 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 border border-purple-100 dark:border-purple-800/50 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 via-transparent to-violet-500/10"></div>
                        <div class="relative p-8">
                            <div class="flex items-start justify-between mb-6">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2 mb-3">
                                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                        <p class="text-sm font-bold text-purple-700 dark:text-purple-300 uppercase tracking-wider">Total Pagos</p>
                                    </div>
                                    <p class="text-4xl font-black text-gray-900 dark:text-white mb-2">{{ number_format($estadisticas['totalPagos']) }}</p>
                                    <div class="flex items-center space-x-2">
                                        <div class="flex items-center px-2 py-1 bg-green-100 dark:bg-green-900/30 rounded-full">
                                            <svg class="w-3 h-3 text-green-600 dark:text-green-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-xs font-bold text-green-700 dark:text-green-300">+15%</span>
                                        </div>
                                        <span class="text-sm text-gray-600 dark:text-gray-300 font-medium">vs mes anterior</span>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-violet-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full bg-purple-100 dark:bg-purple-900/30 rounded-full h-2">
                                <div class="bg-gradient-to-r from-purple-500 to-violet-600 h-2 rounded-full" style="width: 78%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resumen Financiero Mejorado -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Monto Total Contratos -->
                    <div class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 via-indigo-500/5 to-blue-600/10 dark:from-blue-400/20 dark:via-indigo-400/10 dark:to-blue-500/20"></div>
                        <div class="relative p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <p class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-wider mb-2">Valor Total Contratos</p>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white mb-1">$ {{ number_format($estadisticas['montoTotalContratos'], 2) }}</p>
                                    <div class="flex items-center text-sm">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                                        <span class="text-gray-600 dark:text-gray-300 font-medium">Valor contractual total</span>
                                    </div>
                                </div>
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2 rounded-full" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Monto Total Pagado -->
                    <div class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 via-green-500/5 to-emerald-600/10 dark:from-emerald-400/20 dark:via-green-400/10 dark:to-emerald-500/20"></div>
                        <div class="relative p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <p class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider mb-2">Ingresos Recaudados</p>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white mb-1">$ {{ number_format($estadisticas['montoTotalPagos'], 2) }}</p>
                                    <div class="flex items-center text-sm">
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></div>
                                        <span class="text-gray-600 dark:text-gray-300 font-medium">Pagos confirmados</span>
                                    </div>
                                </div>
                                <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            @php
                                $porcentajePagado = $estadisticas['montoTotalContratos'] > 0 ? ($estadisticas['montoTotalPagos'] / $estadisticas['montoTotalContratos']) * 100 : 0;
                            @endphp
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-emerald-500 to-green-600 h-2 rounded-full transition-all duration-500" style="width: {{ min($porcentajePagado, 100) }}%"></div>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 font-medium">{{ number_format($porcentajePagado, 1) }}% del total contractual</p>
                        </div>
                    </div>

                    <!-- Monto Pendiente -->
                    <div class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-amber-500/10 via-orange-500/5 to-red-500/10 dark:from-amber-400/20 dark:via-orange-400/10 dark:to-red-400/20"></div>
                        <div class="relative p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <p class="text-xs font-bold text-amber-600 dark:text-amber-400 uppercase tracking-wider mb-2">Saldo Pendiente</p>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white mb-1">$ {{ number_format($estadisticas['montoPendiente'], 2) }}</p>
                                    <div class="flex items-center text-sm">
                                        <div class="w-2 h-2 bg-amber-500 rounded-full mr-2"></div>
                                        <span class="text-gray-600 dark:text-gray-300 font-medium">Por cobrar</span>
                                    </div>
                                </div>
                                <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            @php
                                $porcentajePendiente = $estadisticas['montoTotalContratos'] > 0 ? ($estadisticas['montoPendiente'] / $estadisticas['montoTotalContratos']) * 100 : 0;
                            @endphp
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-amber-500 to-orange-600 h-2 rounded-full transition-all duration-500" style="width: {{ min($porcentajePendiente, 100) }}%"></div>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 font-medium">{{ number_format($porcentajePendiente, 1) }}% del total contractual</p>
                        </div>
                    </div>
                </div>

                <!-- Tabla de Pagos Recientes -->
                <div class="mb-8">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/20 px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Pagos Recientes</h3>
                                </div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-700">
                                    {{ count($pagosRecientes) }} registros
                                </span>
                            </div>
                        </div>
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700">
                                <thead class="bg-gray-50/50 dark:bg-gray-900/30">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Cliente</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Monto</th>
                                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-50 dark:divide-gray-700/50">
                                    @forelse($pagosRecientes as $pago)
                                    <tr class="hover:bg-emerald-50/50 dark:hover:bg-emerald-900/10 transition-all duration-200">
                                        <td class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">{{ $pago['cliente'] }}</td>
                                        <td class="px-6 py-4 text-sm text-emerald-600 dark:text-emerald-400 text-right font-bold">$ {{ number_format($pago['monto'], 2) }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300 text-center font-medium">{{ $pago['fecha'] }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center space-y-3">
                                                <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                </div>
                                                <div class="text-center">
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white">No hay pagos recientes</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">Los pagos aparecerán aquí cuando se registren</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Gráfico de Pagos por Mes Mejorado -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-50 dark:from-slate-900/50 dark:to-gray-900/50 px-8 py-6 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Análisis de Ingresos Mensuales</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 font-medium">Tendencia de pagos recibidos por mes</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center space-x-2">
                                    <div class="w-3 h-3 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full shadow-sm"></div>
                                    <span class="text-sm text-gray-600 dark:text-gray-300 font-semibold">Ingresos mensuales</span>
                                </div>
                                <div class="hidden sm:flex items-center space-x-2 px-3 py-1 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-100 dark:border-blue-800">
                                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                    <span class="text-xs font-bold text-blue-700 dark:text-blue-300">En tiempo real</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="h-80 relative">
                            <canvas id="pagosPorMes"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('pagosPorMes').getContext('2d');

        // Configuración del tema mejorada
        const isDark = document.documentElement.classList.contains('dark');
        const textColor = isDark ? '#e5e7eb' : '#374151';
        const gridColor = isDark ? '#374151' : '#f3f4f6';
        const backgroundColor = isDark ? '#1f2937' : '#ffffff';

        // Crear gradiente para las barras
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(59, 130, 246, 0.9)');
        gradient.addColorStop(0.5, 'rgba(99, 102, 241, 0.8)');
        gradient.addColorStop(1, 'rgba(139, 92, 246, 0.7)');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($pagosPorMes->toArray())) !!},
                datasets: [{
                    label: 'Ingresos Mensuales',
                    data: {!! json_encode(array_values($pagosPorMes->toArray())) !!},
                    backgroundColor: gradient,
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                    hoverBackgroundColor: 'rgba(59, 130, 246, 1)',
                    hoverBorderColor: 'rgba(99, 102, 241, 1)',
                    hoverBorderWidth: 3,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: backgroundColor,
                        titleColor: textColor,
                        bodyColor: textColor,
                        borderColor: isDark ? '#4b5563' : '#d1d5db',
                        borderWidth: 1,
                        cornerRadius: 12,
                        padding: 12,
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13,
                            weight: '600'
                        },
                        displayColors: false,
                        callbacks: {
                            title: function(context) {
                                return 'Mes: ' + context[0].label;
                            },
                            label: function(context) {
                                return 'Ingresos: $' + context.raw.toLocaleString('es-ES', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        border: {
                            color: gridColor
                        },
                        ticks: {
                            color: textColor,
                            font: {
                                size: 12,
                                weight: '600'
                            },
                            padding: 10
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: gridColor,
                            borderDash: [5, 5],
                            drawBorder: false
                        },
                        border: {
                            display: false
                        },
                        ticks: {
                            color: textColor,
                            font: {
                                size: 12,
                                weight: '600'
                            },
                            padding: 15,
                            callback: function(value) {
                                return '$' + value.toLocaleString('es-ES');
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                animation: {
                    duration: 1500,
                    easing: 'easeInOutQuart'
                },
                hover: {
                    animationDuration: 300
                }
            }
        });
    </script>
    @endpush
</x-app-layout>