<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Contract;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra la lista de pagos.
     */
    public function index()
    {
        $payments = Payment::with('contract')->latest()->paginate(10);
        return view('payments.index', compact('payments'));
    }

    /**
     * Muestra el formulario para crear un nuevo pago.
     */
    public function create()
    {
        $contracts = Contract::all();
        return view('payments.create', compact('contracts'));
    }

    /**
     * Almacena un nuevo pago en la base de datos.
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
            'notas' => 'nullable|string|max:255',
        ]);

        Payment::create($validated);

        return redirect()->route('payments.index')
            ->with('success', 'Pago registrado exitosamente.');
    }

    /**
     * Muestra los detalles de un pago específico.
     */
    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    /**
     * Muestra el formulario para editar un pago existente.
     */
    public function edit(Payment $payment)
    {
        $contracts = Contract::all();
        return view('payments.edit', compact('payment', 'contracts'));
    }

    /**
     * Actualiza un pago específico en la base de datos.
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
            'notas' => 'nullable|string|max:255',
        ]);

        $payment->update($validated);

        return redirect()->route('payments.index')
            ->with('success', 'Pago actualizado exitosamente.');
    }

    /**
     * Elimina un pago específico de la base de datos.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Pago eliminado exitosamente.');
    }
}
