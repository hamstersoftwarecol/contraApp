<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ApiDashboardController extends Controller
{
    /**
     * Obtener estadísticas generales
     */
    public function stats()
    {
        $stats = [
            'total_clients' => Client::count(),
            'active_contracts' => Contract::where('estado', 'activo')->count(),
            'completed_contracts' => Contract::where('estado', 'completado')->count(),
            'cancelled_contracts' => Contract::where('estado', 'cancelado')->count(),
            'total_payments' => Payment::count(),
            'total_income' => Payment::sum('monto'),
            'contracts_overdue' => Contract::where('estado', 'activo')
                ->get()
                ->filter(function($contract) {
                    return $contract->esta_atrasado;
                })
                ->count(),
            'contracts_expiring_soon' => Contract::where('estado', 'activo')
                ->get()
                ->filter(function($contract) {
                    return $contract->esta_por_vencer;
                })
                ->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
        ]);
    }

    /**
     * Obtener pagos recientes
     */
    public function recentPayments(Request $request)
    {
        $limit = $request->get('limit', 10);
        
        $payments = Payment::with('contract.client')
            ->latest('fecha_pago')
            ->limit($limit)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $payments,
        ]);
    }

    /**
     * Obtener estado de contratos (al día, por vencer, atrasados)
     */
    public function contractsStatus()
    {
        $activeContracts = Contract::where('estado', 'activo')->with('client')->get();
        
        $alDia = [];
        $porVencer = [];
        $atrasados = [];
        
        foreach ($activeContracts as $contract) {
            if ($contract->esta_atrasado) {
                $atrasados[] = $contract;
            } elseif ($contract->esta_por_vencer) {
                $porVencer[] = $contract;
            } else {
                $alDia[] = $contract;
            }
        }

        return response()->json([
            'success' => true,
            'data' => [
                'al_dia' => $alDia,
                'por_vencer' => $porVencer,
                'atrasados' => $atrasados,
            ],
        ]);
    }

    /**
     * Obtener ingresos mensuales (últimos 12 meses)
     */
    public function monthlyIncome(Request $request)
    {
        $months = $request->get('months', 12);
        $monthlyData = [];
        
        for ($i = $months - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $startOfMonth = $date->copy()->startOfMonth();
            $endOfMonth = $date->copy()->endOfMonth();
            
            $income = Payment::whereBetween('fecha_pago', [$startOfMonth, $endOfMonth])
                ->sum('monto');
            
            $monthlyData[] = [
                'month' => $date->format('Y-m'),
                'month_name' => $date->locale('es')->translatedFormat('F Y'),
                'income' => (float) $income,
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $monthlyData,
        ]);
    }
}
