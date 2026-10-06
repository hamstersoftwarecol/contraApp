<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contract;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Estadísticas generales
        $estadisticas = [
            'totalClientes' => Client::count(),
            'totalContratos' => Contract::count(),
            'totalPagos' => Payment::count(),
            'montoTotalPagos' => Payment::sum('monto'),
            'montoTotalContratos' => Contract::sum('monto_total'),
            'montoPendiente' => Contract::sum('monto_total') - Payment::sum('monto'),
        ];

        // Pagos recientes (últimos 5)
        $pagosRecientes = Payment::with(['contract.client'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($pago) {
                return [
                    'id' => $pago->id,
                    'monto' => $pago->monto,
                    'fecha' => Carbon::parse($pago->fecha_pago)->format('d/m/Y'),
                    'cliente' => $pago->contract && $pago->contract->client
                        ? $pago->contract->client->nombre . ' ' . $pago->contract->client->apellido
                        : 'Cliente no disponible',
                    'metodo' => $pago->metodo_pago,
                    'referencia' => $pago->referencia,
                ];
            });

        // Contratos próximos a vencer (próximos 30 días)
        $contratosProximos = Contract::with('client')
            ->where('estado', 'activo')
            ->where('fecha_fin', '>=', now())
            ->where('fecha_fin', '<=', now()->addDays(30))
            ->get()
            ->map(function ($contrato) {
                return [
                    'id' => $contrato->id,
                    'cliente' => $contrato->client
                        ? $contrato->client->nombre . ' ' . $contrato->client->apellido
                        : 'Cliente no disponible',
                    'fecha_fin' => Carbon::parse($contrato->fecha_fin)->format('d/m/Y'),
                    'dias_restantes' => Carbon::now()->diffInDays($contrato->fecha_fin),
                    'monto_total' => $contrato->monto_total,
                    'monto_pagado' => $contrato->payments->sum('monto'),
                ];
            });

        // Pagos atrasados
        $pagosAtrasados = Contract::with(['client', 'payments'])
            ->where('estado', 'activo')
            ->get()
            ->filter(function ($contrato) {
                $montoPagado = $contrato->payments->sum('monto');
                $cuotaMensual = ($contrato->duration_months > 0) ? ($contrato->monto_total / $contrato->duration_months) : 0;
                $mesesTranscurridos = Carbon::parse($contrato->start_date)->diffInMonths(now());
                $montoEsperado = $cuotaMensual * $mesesTranscurridos;

                return $montoPagado < $montoEsperado;
            })
            ->map(function ($contrato) {
                $montoPagado = $contrato->payments->sum('monto');
                $cuotaMensual = ($contrato->duration_months > 0) ? ($contrato->monto_total / $contrato->duration_months) : 0;
                $mesesTranscurridos = Carbon::parse($contrato->start_date)->diffInMonths(now());
                $montoEsperado = $cuotaMensual * $mesesTranscurridos;

                return [
                    'id' => $contrato->id,
                    'cliente' => $contrato->client
                        ? $contrato->client->nombre . ' ' . $contrato->client->apellido
                        : 'Cliente no disponible',
                    'monto_esperado' => $montoEsperado,
                    'monto_pagado' => $montoPagado,
                    'monto_atrasado' => max(0, $montoEsperado - $montoPagado),
                    'dias_atraso' => Carbon::parse($contrato->fecha_inicio ?? $contrato->start_date)
                        ->addMonths($mesesTranscurridos)
                        ->diffInDays(now()),
                ];
            })
            ->filter(function ($pago) {
                return $pago['monto_atrasado'] > 0;
            })
            ->values();

        // Pagos por mes (año actual)
        $monthSql = DB::connection()->getDriverName() === 'sqlite'
            ? "cast(strftime('%m', fecha_pago) as integer)"
            : 'MONTH(fecha_pago)';

        $pagosPorMes = Payment::selectRaw("{$monthSql} as mes, SUM(monto) as total")
            ->whereYear('fecha_pago', date('Y'))
            ->groupBy('mes')
            ->orderBy('mes')
            ->get()
            ->mapWithKeys(function ($pago) {
                $mes = str_pad($pago->mes, 2, '0', STR_PAD_LEFT);
                $nombreMes = Carbon::createFromFormat('m', $mes)->locale('es')->monthName;
                return [ucfirst($nombreMes) => $pago->total];
            });

        // Clientes más activos (con más contratos activos)
        $clientesActivos = Client::select('clients.*')
            ->selectSub(
                Contract::selectRaw('COUNT(*)')
                    ->whereColumn('clients.id', 'contracts.client_id')
                    ->where('estado', 'activo'),
                'contracts_count'
            )
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('contracts')
                    ->whereColumn('clients.id', 'contracts.client_id')
                    ->where('estado', 'activo');
            })
            ->orderByDesc('contracts_count')
            ->take(5)
            ->get()
            ->map(function ($cliente) {
                return [
                    'nombre' => $cliente->nombre . ' ' . $cliente->apellido,
                    'contratos' => $cliente->contracts_count,
                    'total_pagado' => $cliente->contracts->sum(function ($contrato) {
                        return $contrato->payments->sum('monto');
                    }),
                ];
            });

        return view('dashboard', compact(
            'estadisticas',
            'pagosRecientes',
            'contratosProximos',
            'pagosAtrasados',
            'pagosPorMes',
            'clientesActivos'
        ));
    }
} 