<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-amber-50 to-orange-100 dark:from-gray-900 dark:via-amber-900 dark:to-orange-900 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-4xl font-black text-gray-900 dark:text-white tracking-tight mb-2">
                                Editar Cliente
                            </h1>
                            <p class="text-lg text-gray-600 dark:text-gray-300 font-medium">
                                Actualiza la información de <span class="font-bold text-amber-600 dark:text-amber-400">{{ $client->nombre_completo }}</span>
                            </p>
                        </div>
                        <div class="hidden sm:block">
                            <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-xl">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client Info Card -->
            <div class="mb-8">
                <div class="bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 rounded-2xl border border-amber-200 dark:border-amber-700 p-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold text-2xl">{{ strtoupper(substr($client->nombre, 0, 1)) }}{{ strtoupper(substr($client->apellido, 0, 1)) }}</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $client->nombre_completo }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Cédula: {{ $client->cedula }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Cliente desde: {{ $client->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Contratos activos</p>
                            <p class="text-2xl font-bold text-amber-600 dark:text-amber-400">{{ $client->contracts->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 px-8 py-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Actualizar Información</h3>
                    </div>
                </div>

                <div class="p-8">
                    <form action="{{ route('clients.update', $client) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Información Personal -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Tipo de Identificación -->
                            <div class="space-y-2">
                                <label for="tipo_identificacion" class="flex items-center text-sm font-bold text-gray-700 dark:text-gray-300">
                                    <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Tipo de Identificación *
                                </label>
                                <select name="tipo_identificacion" id="tipo_identificacion" required
                                    class="block w-full px-4 py-3 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 dark:focus:ring-amber-400 dark:focus:border-amber-400 transition-all duration-200">
                                    <option value="CC" {{ old('tipo_identificacion', $client->tipo_identificacion) == 'CC' ? 'selected' : '' }}>C.C - Cédula de Ciudadanía</option>
                                    <option value="CE" {{ old('tipo_identificacion', $client->tipo_identificacion) == 'CE' ? 'selected' : '' }}>C.E - Cédula de Extranjería</option>
                                    <option value="NIT" {{ old('tipo_identificacion', $client->tipo_identificacion) == 'NIT' ? 'selected' : '' }}>NIT - Número de Identificación Tributaria</option>
                                    <option value="PPT" {{ old('tipo_identificacion', $client->tipo_identificacion) == 'PPT' ? 'selected' : '' }}>PPT - Permiso de Protección Temporal</option>
                                </select>
                            </div>

                            <!-- Número de Identificación -->
                            <div class="space-y-2">
                                <label for="cedula" class="flex items-center text-sm font-bold text-gray-700 dark:text-gray-300">
                                    <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-4 0v2m0 0h4"></path>
                                    </svg>
                                    Número de Identificación *
                                </label>
                                <input type="text" name="cedula" id="cedula" value="{{ old('cedula', $client->cedula) }}" required
                                    class="block w-full px-4 py-3 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 dark:focus:ring-amber-400 dark:focus:border-amber-400 transition-all duration-200 placeholder-gray-400 dark:placeholder-gray-500"
                                    placeholder="Ej: 12345678">
                                @error('cedula')
                                    <div class="flex items-center mt-2 text-sm text-red-600 dark:text-red-400">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Nombre (solo para CC, CE, PPT) -->
                            <div class="space-y-2" id="nombre-container">
                                <label for="nombre" class="flex items-center text-sm font-bold text-gray-700 dark:text-gray-300">
                                    <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Nombre *
                                </label>
                                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $client->nombre) }}"
                                    class="block w-full px-4 py-3 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 dark:focus:ring-amber-400 dark:focus:border-amber-400 transition-all duration-200 placeholder-gray-400 dark:placeholder-gray-500"
                                    placeholder="Ej: Juan Carlos">
                                @error('nombre')
                                    <div class="flex items-center mt-2 text-sm text-red-600 dark:text-red-400">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Apellido (solo para CC, CE, PPT) -->
                            <div class="space-y-2" id="apellido-container">
                                <label for="apellido" class="flex items-center text-sm font-bold text-gray-700 dark:text-gray-300">
                                    <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Apellido *
                                </label>
                                <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $client->apellido) }}"
                                    class="block w-full px-4 py-3 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 dark:focus:ring-amber-400 dark:focus:border-amber-400 transition-all duration-200 placeholder-gray-400 dark:placeholder-gray-500"
                                    placeholder="Ej: Pérez González">
                                @error('apellido')
                                    <div class="flex items-center mt-2 text-sm text-red-600 dark:text-red-400">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Razón Social (solo para NIT) -->
                            <div class="space-y-2 lg:col-span-2 hidden" id="razon-social-container">
                                <label for="razon_social" class="flex items-center text-sm font-bold text-gray-700 dark:text-gray-300">
                                    <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Razón Social *
                                </label>
                                <input type="text" name="razon_social" id="razon_social" value="{{ old('razon_social', $client->razon_social) }}"
                                    class="block w-full px-4 py-3 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 dark:focus:ring-amber-400 dark:focus:border-amber-400 transition-all duration-200 placeholder-gray-400 dark:placeholder-gray-500"
                                    placeholder="Ej: Empresa S.A.S">
                                @error('razon_social')
                                    <div class="flex items-center mt-2 text-sm text-red-600 dark:text-red-400">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="space-y-2">
                                <label for="email" class="flex items-center text-sm font-bold text-gray-700 dark:text-gray-300">
                                    <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Correo Electrónico
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email', $client->email) }}"
                                    class="block w-full px-4 py-3 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 dark:focus:ring-amber-400 dark:focus:border-amber-400 transition-all duration-200 placeholder-gray-400 dark:placeholder-gray-500"
                                    placeholder="Ej: juan.perez@email.com">
                                @error('email')
                                    <div class="flex items-center mt-2 text-sm text-red-600 dark:text-red-400">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Teléfono -->
                            <div class="space-y-2">
                                <label for="telefono" class="flex items-center text-sm font-bold text-gray-700 dark:text-gray-300">
                                    <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    Número de Teléfono
                                </label>
                                <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $client->telefono) }}"
                                    class="block w-full px-4 py-3 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 dark:focus:ring-amber-400 dark:focus:border-amber-400 transition-all duration-200 placeholder-gray-400 dark:placeholder-gray-500"
                                    placeholder="Ej: +58 412 123 4567">
                                @error('telefono')
                                    <div class="flex items-center mt-2 text-sm text-red-600 dark:text-red-400">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="space-y-2">
                            <label for="direccion" class="flex items-center text-sm font-bold text-gray-700 dark:text-gray-300">
                                <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Dirección Completa
                            </label>
                            <textarea name="direccion" id="direccion" rows="4"
                                class="block w-full px-4 py-3 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 dark:focus:ring-amber-400 dark:focus:border-amber-400 transition-all duration-200 placeholder-gray-400 dark:placeholder-gray-500 resize-none"
                                placeholder="Ej: Av. Principal, Edificio Torre Azul, Piso 5, Apto 5B, Caracas, Venezuela">{{ old('direccion', $client->direccion) }}</textarea>
                            @error('direccion')
                                <div class="flex items-center mt-2 text-sm text-red-600 dark:text-red-400">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Nota informativa -->
                        <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-700 rounded-xl p-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-amber-600 dark:text-amber-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-amber-800 dark:text-amber-200">Información importante</p>
                                    <p class="text-sm text-amber-700 dark:text-amber-300 mt-1">Los cambios se aplicarán inmediatamente. Los campos marcados con (*) son obligatorios.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="flex flex-col sm:flex-row items-center justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('clients.index') }}"
                               class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancelar
                            </a>
                            <button type="submit"
                                    class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-200 transform hover:scale-105">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Actualizar Cliente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipoIdentificacion = document.getElementById('tipo_identificacion');
            const nombreContainer = document.getElementById('nombre-container');
            const apellidoContainer = document.getElementById('apellido-container');
            const razonSocialContainer = document.getElementById('razon-social-container');
            const nombreInput = document.getElementById('nombre');
            const apellidoInput = document.getElementById('apellido');
            const razonSocialInput = document.getElementById('razon_social');

            function toggleFields() {
                const tipo = tipoIdentificacion.value;

                if (tipo === 'NIT') {
                    nombreContainer.classList.add('hidden');
                    apellidoContainer.classList.add('hidden');
                    razonSocialContainer.classList.remove('hidden');
                    nombreInput.removeAttribute('required');
                    apellidoInput.removeAttribute('required');
                    razonSocialInput.setAttribute('required', 'required');
                } else {
                    nombreContainer.classList.remove('hidden');
                    apellidoContainer.classList.remove('hidden');
                    razonSocialContainer.classList.add('hidden');
                    nombreInput.setAttribute('required', 'required');
                    apellidoInput.setAttribute('required', 'required');
                    razonSocialInput.removeAttribute('required');
                }
            }

            tipoIdentificacion.addEventListener('change', toggleFields);
            toggleFields();
        });
    </script>
</x-app-layout>