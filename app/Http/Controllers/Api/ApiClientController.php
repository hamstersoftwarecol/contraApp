<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ApiClientController extends Controller
{
    /**
     * Listar todos los clientes
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $search = $request->get('search');
        
        $query = Client::with('contracts');
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('apellido', 'like', "%{$search}%")
                  ->orWhere('razon_social', 'like', "%{$search}%")
                  ->orWhere('cedula', 'like', "%{$search}%");
            });
        }
        
        $clients = $query->latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $clients,
        ]);
    }

    /**
     * Crear un nuevo cliente
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo_identificacion' => 'required|in:CC,NIT,CE,PPT',
            'cedula' => 'required|unique:clients',
            'nombre' => 'required_unless:tipo_identificacion,NIT',
            'apellido' => 'required_unless:tipo_identificacion,NIT',
            'razon_social' => 'required_if:tipo_identificacion,NIT',
            'email' => 'nullable|email',
            'telefono' => 'nullable',
            'direccion' => 'nullable',
        ]);

        $client = Client::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Cliente creado exitosamente',
            'data' => $client,
        ], 201);
    }

    /**
     * Mostrar un cliente específico
     */
    public function show(Client $client)
    {
        $client->load(['contracts' => function($query) {
            $query->with('payments');
        }]);

        return response()->json([
            'success' => true,
            'data' => $client,
        ]);
    }

    /**
     * Actualizar un cliente
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'tipo_identificacion' => 'required|in:CC,NIT,CE,PPT',
            'cedula' => 'required|unique:clients,cedula,' . $client->id,
            'nombre' => 'required_unless:tipo_identificacion,NIT',
            'apellido' => 'required_unless:tipo_identificacion,NIT',
            'razon_social' => 'required_if:tipo_identificacion,NIT',
            'email' => 'nullable|email',
            'telefono' => 'nullable',
            'direccion' => 'nullable',
        ]);

        $client->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Cliente actualizado exitosamente',
            'data' => $client,
        ]);
    }

    /**
     * Eliminar un cliente
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cliente eliminado exitosamente',
        ]);
    }

    /**
     * Obtener contratos de un cliente
     */
    public function contracts(Client $client)
    {
        $contracts = $client->contracts()->with('payments')->get();

        return response()->json([
            'success' => true,
            'data' => $contracts,
        ]);
    }
}
