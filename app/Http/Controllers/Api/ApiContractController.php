<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Client;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ApiContractController extends Controller
{
    /**
     * Listar todos los contratos
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $search = $request->get('search');
        $estado = $request->get('estado');
        
        $query = Contract::with(['client', 'payments']);
        
        if ($search) {
            $query->whereHas('client', function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('apellido', 'like', "%{$search}%")
                  ->orWhere('cedula', 'like', "%{$search}%");
            });
        }
        
        if ($estado) {
            $query->where('estado', $estado);
        }
        
        $contracts = $query->latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $contracts,
        ]);
    }

    /**
     * Crear un nuevo contrato
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'monto_total' => 'required|numeric|min:0',
            'numero_cuotas' => 'required|integer|min:1',
            'fecha_inicio' => 'required|date',
            'descripcion' => 'nullable|string',
        ]);

        $validated['monto_cuota'] = $validated['monto_total'] / $validated['numero_cuotas'];
        $validated['estado'] = 'activo';

        $contract = Contract::create($validated);
        $contract->load(['client', 'payments']);

        return response()->json([
            'success' => true,
            'message' => 'Contrato creado exitosamente',
            'data' => $contract,
        ], 201);
    }

    /**
     * Mostrar un contrato específico
     */
    public function show(Contract $contract)
    {
        $contract->load(['client', 'payments']);

        return response()->json([
            'success' => true,
            'data' => $contract,
        ]);
    }

    /**
     * Actualizar un contrato
     */
    public function update(Request $request, Contract $contract)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'monto_total' => 'required|numeric|min:0',
            'numero_cuotas' => 'required|integer|min:1',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|in:activo,completado,cancelado',
            'descripcion' => 'nullable|string',
        ]);

        $validated['monto_cuota'] = $validated['monto_total'] / $validated['numero_cuotas'];

        $contract->update($validated);
        $contract->load(['client', 'payments']);

        return response()->json([
            'success' => true,
            'message' => 'Contrato actualizado exitosamente',
            'data' => $contract,
        ]);
    }

    /**
     * Eliminar un contrato
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();

        return response()->json([
            'success' => true,
            'message' => 'Contrato eliminado exitosamente',
        ]);
    }

    /**
     * Obtener pagos de un contrato
     */
    public function payments(Contract $contract)
    {
        $payments = $contract->payments()->latest('fecha_pago')->get();

        return response()->json([
            'success' => true,
            'data' => $payments,
        ]);
    }

    /**
     * Firmar un contrato
     */
    public function sign(Request $request, Contract $contract)
    {
        $validated = $request->validate([
            'firma' => 'required|string', // base64
        ]);

        $contract->firma = $validated['firma'];
        $contract->save();

        return response()->json([
            'success' => true,
            'message' => 'Contrato firmado exitosamente',
            'data' => $contract,
        ]);
    }

    /**
     * Firmar un contrato de forma pública (con validación de cédula)
     */
    public function signPublic(Request $request, Contract $contract)
    {
        $validated = $request->validate([
            'firma' => 'required|string', // base64
            'cedula' => 'required|string',
        ]);

        // Verificar que la cédula coincida con el cliente del contrato
        $contract->load('client');
        
        if ($contract->client->cedula !== $validated['cedula']) {
            return response()->json([
                'success' => false,
                'message' => 'No tiene autorización para firmar este contrato',
            ], 403);
        }

        $contract->firma = $validated['firma'];
        $contract->save();

        return response()->json([
            'success' => true,
            'message' => 'Contrato firmado exitosamente',
            'data' => $contract,
        ]);
    }

    /**
     * Descargar PDF del contrato
     */
    public function downloadPdf(Contract $contract)
    {
        setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain', 'Spanish');
        $pdf = PDF::loadView('contracts.pdf', [
            'contract' => $contract
        ]);
        
        return $pdf->download('contrato-' . $contract->id . '.pdf');
    }
}
