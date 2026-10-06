<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Client;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ContractController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['downloadPdf', 'firmar', 'guardarFirma']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contract::with(['client', 'payments'])->paginate(10);
        return view('contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view('contracts.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'monto_total' => 'required|numeric|min:0',
            'numero_cuotas' => 'required|integer|min:1',
            'fecha_inicio' => 'required|date',
            'descripcion' => 'nullable'
        ]);

        $validated['monto_cuota'] = $validated['monto_total'] / $validated['numero_cuotas'];
        $validated['estado'] = 'activo';

        Contract::create($validated);

        return redirect()->route('contracts.index')
            ->with('success', 'Contrato creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        $contract->load(['client', 'payments']);
        return view('contracts.show', compact('contract'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        $clients = Client::all();
        return view('contracts.edit', compact('contract', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'monto_total' => 'required|numeric|min:0',
            'numero_cuotas' => 'required|integer|min:1',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|in:activo,completado,cancelado',
            'descripcion' => 'nullable'
        ]);

        $validated['monto_cuota'] = $validated['monto_total'] / $validated['numero_cuotas'];

        $contract->update($validated);

        return redirect()->route('contracts.index')
            ->with('success', 'Contrato actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();

        return redirect()->route('contracts.index')
            ->with('success', 'Contrato eliminado exitosamente.');
    }

    public function downloadPdf(Request $request, Contract $contract)
    {
        // Validar cédula por query param solo para usuarios no autenticados
        $cedula = $request->query('cedula');
        if (!auth()->check() && $cedula !== $contract->client->cedula) {
            abort(403, 'No autorizado para descargar este contrato.');
        }
        
        setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain', 'Spanish');
        $pdf = PDF::loadView('contracts.pdf', [
            'contract' => $contract
        ]);
        return $pdf->download('contrato-' . $contract->id . '.pdf');
    }

    public function firmar(Request $request, Contract $contract)
    {
        // Validar cédula por query param solo para usuarios no autenticados
        $cedula = $request->query('cedula');
        if (!auth()->check() && $cedula !== $contract->client->cedula) {
            abort(403, 'No autorizado para firmar este contrato.');
        }
        if ($contract->firma) {
            return redirect()->route('contracts.show', $contract)->with('info', 'El contrato ya está firmado.');
        }
        return view('contracts.firmar', compact('contract'));
    }

    public function guardarFirma(Request $request, Contract $contract)
    {
        // Validar cédula por query param solo para usuarios no autenticados
        $cedula = $request->query('cedula');
        if (!auth()->check() && $cedula !== $contract->client->cedula) {
            abort(403, 'No autorizado para firmar este contrato.');
        }
        $request->validate([
            'firma' => 'required|string', // base64
        ]);
        $contract->firma = $request->firma;
        $contract->save();
        
        // Redirigir según el tipo de usuario
        if (auth()->check()) {
            return redirect()->route('contracts.show', $contract)
                ->with('success', '¡Contrato firmado correctamente!');
        } else {
            // Redirigir a la búsqueda pública con mensaje de éxito
            return redirect()->route('public.search.results', ['cedula' => $cedula])
                ->with('success', '¡Contrato firmado correctamente!');
        }
    }
}
