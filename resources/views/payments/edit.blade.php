<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Pago') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('payments.update', $payment) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="contract_id" class="block text-sm font-medium text-gray-700">Contrato</label>
                            <select name="contract_id" id="contract_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Seleccione un contrato</option>
                                @foreach($contracts as $contract)
                                    <option value="{{ $contract->id }}" {{ (old('contract_id', $payment->contract_id) == $contract->id) ? 'selected' : '' }}>
                                        #{{ $contract->id }} - {{ $contract->client->nombre_completo }} 
                                        (Pendiente: ${{ number_format($contract->monto_pendiente + ($payment->contract_id == $contract->id ? $payment->monto : 0), 2) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('contract_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="numero_cuota" class="block text-sm font-medium text-gray-700">Número de Cuota</label>
                            <input type="number" name="numero_cuota" id="numero_cuota" value="{{ old('numero_cuota', $payment->numero_cuota) }}" required 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('numero_cuota')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="monto" class="block text-sm font-medium text-gray-700">Monto</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="number" name="monto" id="monto" step="0.01" value="{{ old('monto', $payment->monto) }}" required
                                    class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            @error('monto')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="fecha_pago" class="block text-sm font-medium text-gray-700">Fecha de Pago</label>
                            <input type="date" name="fecha_pago" id="fecha_pago" value="{{ old('fecha_pago', $payment->fecha_pago->format('Y-m-d')) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('fecha_pago')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="metodo_pago" class="block text-sm font-medium text-gray-700">Método de Pago</label>
                            <select name="metodo_pago" id="metodo_pago" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Seleccione un método</option>
                                <option value="efectivo" {{ old('metodo_pago', $payment->metodo_pago) == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                                <option value="transferencia" {{ old('metodo_pago', $payment->metodo_pago) == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                                <option value="tarjeta" {{ old('metodo_pago', $payment->metodo_pago) == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                            </select>
                            @error('metodo_pago')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="referencia" class="block text-sm font-medium text-gray-700">Referencia</label>
                            <input type="text" name="referencia" id="referencia" value="{{ old('referencia', $payment->referencia) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('referencia')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="notas" class="block text-sm font-medium text-gray-700">Notas</label>
                            <textarea name="notas" id="notas" rows="3" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notas', $payment->notas) }}</textarea>
                            @error('notas')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('payments.show', $payment) }}" 
                                class="bg-gray-200 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Cancelar
                            </a>
                            <button type="submit" 
                                class="bg-indigo-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Actualizar Pago
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const contractSelect = document.getElementById('contract_id');
            const montoInput = document.getElementById('monto');
            const originalMonto = {{ $payment->monto }};
            const originalContractId = {{ $payment->contract_id }};
            
            // Función para calcular el monto máximo permitido
            function calcularMontoMaximo() {
                const selectedOption = contractSelect.options[contractSelect.selectedIndex];
                if (selectedOption.value) {
                    let pendiente = parseFloat(selectedOption.textContent.match(/Pendiente: \$([0-9,]+(\.[0-9]{2})?)/)[1].replace(/,/g, ''));
                    
                    // Si es el mismo contrato, añadimos el monto original para permitir editar sin restricción
                    if (parseInt(selectedOption.value) === originalContractId) {
                        pendiente += originalMonto;
                    }
                    
                    montoInput.setAttribute('max', pendiente);
                    return pendiente;
                }
                return 0;
            }

            // Calcular el monto máximo inicial
            calcularMontoMaximo();

            // Validar monto cuando se selecciona un contrato
            contractSelect.addEventListener('change', function() {
                const pendiente = calcularMontoMaximo();
                if (pendiente > 0) {
                    // Mostrar mensaje informativo
                    Toast.fire({
                        icon: 'info',
                        title: `Monto disponible: $${pendiente.toFixed(2)}`
                    });
                }
            });

            // Validar el formulario antes de enviar
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validar que se haya seleccionado un contrato
                if (!contractSelect.value) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Por favor seleccione un contrato'
                    });
                    return;
                }

                // Validar que el monto no sea mayor al pendiente
                const monto = parseFloat(montoInput.value);
                const maxMonto = parseFloat(montoInput.getAttribute('max'));
                if (monto > maxMonto) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: `El monto no puede ser mayor a $${maxMonto.toFixed(2)}`
                    });
                    return;
                }

                // Confirmar la actualización del pago
                Swal.fire({
                    title: '¿Confirmar actualización de pago?',
                    text: `¿Está seguro de actualizar este pago a $${monto.toFixed(2)}?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, actualizar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Mostrar loading
                        Swal.fire({
                            title: 'Procesando...',
                            text: 'Por favor espere',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        // Enviar el formulario
                        form.submit();
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout> 