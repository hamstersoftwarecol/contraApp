<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contract;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function search(Request $request)
    {
        $cedula = $request->get('cedula');
        
        if (empty($cedula)) {
            return redirect()->route('public.search')
                ->with('error', 'Por favor ingrese un número de cédula o NIT.');
        }

        // Limpiar la cédula de caracteres especiales
        $cedula = preg_replace('/[^0-9]/', '', $cedula);

        $client = Client::where('cedula', 'LIKE', '%' . $cedula . '%')
            ->with(['contracts' => function($query) {
                $query->orderBy('created_at', 'desc');
            }, 'contracts.payments' => function($query) {
                $query->orderBy('fecha_pago', 'desc');
            }])
            ->first();

        if (!$client) {
            return redirect()->route('public.search')
                ->with('error', 'No se encontraron registros asociados a esta cédula o NIT.');
        }

        $contracts = $client->contracts;

        return view('public.search-results', compact('client', 'cedula', 'contracts'));
    }
}
