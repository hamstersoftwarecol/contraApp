<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Contract;
use Illuminate\Http\Request;

class ApiPaymentController extends Controller
{
    /**
     * Listar todos los pagos
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $search = $request->get('search');
        $metodo_pago = $request->get('metodo_pago');
        $fecha_inicio = $request->get('fecha_inicio');
        $fecha_fin = $request->get('fecha_fin');
        
        $query = Payment::with('contract.client');
        
        if ($search) {
            $query->whereHas('contract.client', function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('apellido', 'like', "%{$search}%")
                  ->orWhere('cedula', 'like', "%{$search}%");
            });
        }
        
        if ($metodo_pago) {
            $query->where('metodo_pago', $metodo_pago);
        }
        
        if ($fecha_inicio && $fecha_fin) {
            $query->whereBetween('fecha_pago', [$fecha_inicio, $fecha_fin]);
        }
        
        $payments = $query->latest('fecha_pago')->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $payments,
        ]);
    }

    /**
     * Crear un nuevo pago
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'contract_id' => 'required|exists:contracts,id',
            'numero_cuota' => 'required|integer|min:1',
            'monto' => 'required|numeric|min:0',
            'fecha_pago' => 'required|date',
            'metodo_pago' => 'required|in:efectivo,transferencia,tarjeta',
            'referencia' => 'nullable|string|max:255',
            'notas' => 'nullable|string',
        ]);

        $payment = Payment::create($validated);
        $payment->load('contract.client');

        return response()->json([
            'success' => true,
            'message' => 'Pago registrado exitosamente',
            'data' => $payment,
        ], 201);
    }

    /**
     * Mostrar un pago específico
     */
    public function show(Payment $payment)
    {
        $payment->load('contract.client');

        return response()->json([
            'success' => true,
            'data' => $payment,
        ]);
    }

    /**
     * Actualizar un pago
     */
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'contract_id' => 'required|exists:contracts,id',
            'numero_cuota' => 'required|integer|min:1',
            'monto' => 'required|numeric|min:0',
            'fecha_pago' => 'required|date',
            'metodo_pago' => 'required|in:efectivo,transferencia,tarjeta',
            'referencia' => 'nullable|string|max:255',
            'notas' => 'nullable|string',
        ]);

        $payment->update($validated);
        $payment->load('contract.client');

        return response()->json([
            'success' => true,
            'message' => 'Pago actualizado exitosamente',
            'data' => $payment,
        ]);
    }

    /**
     * Eliminar un pago
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pago eliminado exitosamente',
        ]);
    }

    /**
     * Obtener pagos por contrato
     */
    public function byContract(Contract $contract)
    {
        $payments = $contract->payments()->latest('fecha_pago')->get();

        return response()->json([
            'success' => true,
            'data' => $payments,
        ]);
    }
}
