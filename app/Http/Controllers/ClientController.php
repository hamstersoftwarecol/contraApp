<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::with('contracts')->paginate(10);
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
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
            'direccion' => 'nullable'
        ]);

        Client::create($validated);

        return redirect()->route('clients.index')
            ->with('success', 'Cliente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $client->load(['contracts' => function($query) {
            $query->with('payments');
        }]);
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
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
            'direccion' => 'nullable'
        ]);

        $client->update($validated);

        return redirect()->route('clients.index')
            ->with('success', 'Cliente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Cliente eliminado exitosamente.');
    }
}
