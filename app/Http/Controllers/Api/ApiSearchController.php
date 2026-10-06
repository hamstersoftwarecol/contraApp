<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class ApiSearchController extends Controller
{
    /**
     * Búsqueda pública de contratos por cédula
     */
    public function searchContracts(Request $request)
    {
        $request->validate([
            'cedula' => 'required|string',
        ]);

        $contracts = Contract::with(['client', 'payments'])
            ->whereHas('client', function($query) use ($request) {
                $query->where('cedula', $request->cedula);
            })
            ->get();

        if ($contracts->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontraron contratos para esta cédula',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $contracts,
        ]);
    }
}
