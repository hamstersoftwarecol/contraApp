<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'monto_total',
        'numero_cuotas',
        'monto_cuota',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'descripcion',
        'firma',
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'monto_total' => 'float',
        'monto_cuota' => 'float',
        'numero_cuotas' => 'integer'
    ];

    protected $appends = [
        'esta_por_vencer',
        'esta_atrasado',
        'dias_atraso',
        'dias_para_vencer'
    ];

    protected static function booted()
    {
        static::creating(function ($contract) {
            // Calcular monto_cuota si no está establecido
            if (!$contract->monto_cuota) {
                $contract->monto_cuota = (float)$contract->monto_total / (int)$contract->numero_cuotas;
            }

            // Calcular fecha_fin si no está establecida
            if (!$contract->fecha_fin) {
                $fechaInicio = Carbon::parse($contract->fecha_inicio);
                $contract->fecha_fin = $fechaInicio->copy()->addMonths((int)$contract->numero_cuotas);
            }
        });

        static::updating(function ($contract) {
            // Recalcular monto_cuota si cambió el monto_total o numero_cuotas
            if ($contract->isDirty(['monto_total', 'numero_cuotas'])) {
                $contract->monto_cuota = (float)$contract->monto_total / (int)$contract->numero_cuotas;
            }

            // Recalcular fecha_fin si cambió fecha_inicio o numero_cuotas
            if ($contract->isDirty(['fecha_inicio', 'numero_cuotas']) && !$contract->isDirty('fecha_fin')) {
                $fechaInicio = Carbon::parse($contract->fecha_inicio);
                $contract->fecha_fin = $fechaInicio->copy()->addMonths((int)$contract->numero_cuotas);
            }
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getCuotasPagadasAttribute()
    {
        return $this->payments()->count();
    }

    public function getCuotasPendientesAttribute()
    {
        return (int)$this->numero_cuotas - $this->cuotas_pagadas;
    }

    public function getMontoPagadoAttribute()
    {
        return (float)$this->payments()->sum('monto');
    }

    public function getMontoPendienteAttribute()
    {
        return (float)$this->monto_total - $this->monto_pagado;
    }

    public function getDiasRestantesAttribute()
    {
        if (!$this->fecha_fin) {
            return null;
        }
        $fechaFin = Carbon::parse($this->fecha_fin);
        $ahora = Carbon::now();
        return (int)$fechaFin->diffInDays($ahora, false);
    }

    public function getProximoVencimientoAttribute()
    {
        $ultimoPago = $this->payments()->latest('fecha_pago')->first();
        if ($ultimoPago) {
            $fechaBase = Carbon::parse($ultimoPago->fecha_pago);
        } else {
            $fechaBase = Carbon::parse($this->fecha_inicio);
        }
        return $fechaBase->copy()->addMonth();
    }

    // Nuevas funciones para verificar estados
    public function getEstaPorVencerAttribute()
    {
        if ($this->estado !== 'activo') {
            return false;
        }
        
        $fechaFin = Carbon::parse($this->fecha_fin);
        $ahora = Carbon::now();
        $diasParaVencer = $fechaFin->diffInDays($ahora, false);
        
        return $diasParaVencer > 0 && $diasParaVencer <= 30;
    }

    public function getEstaAtrasadoAttribute()
    {
        if ($this->estado !== 'activo') {
            return false;
        }

        $ultimoPago = $this->payments()->latest('fecha_pago')->first();
        $fechaReferencia = $ultimoPago ? 
            Carbon::parse($ultimoPago->fecha_pago)->addMonth() : 
            Carbon::parse($this->fecha_inicio)->addMonth();

        return Carbon::now()->gt($fechaReferencia);
    }

    public function getDiasAtrasoAttribute()
    {
        if (!$this->esta_atrasado) {
            return 0;
        }

        $ultimoPago = $this->payments()->latest('fecha_pago')->first();
        $fechaReferencia = $ultimoPago ? 
            Carbon::parse($ultimoPago->fecha_pago)->addMonth() : 
            Carbon::parse($this->fecha_inicio)->addMonth();

        return Carbon::now()->diffInDays($fechaReferencia);
    }

    public function getDiasParaVencerAttribute()
    {
        if (!$this->esta_por_vencer) {
            return 0;
        }

        $fechaFin = Carbon::parse($this->fecha_fin);
        return Carbon::now()->diffInDays($fechaFin, false);
    }

    public function getEstadoFormateadoAttribute()
    {
        if ($this->esta_atrasado) {
            return [
                'texto' => 'Atrasado',
                'clase' => 'text-red-600',
                'dias' => $this->dias_atraso . ' días de atraso'
            ];
        }
        
        if ($this->esta_por_vencer) {
            return [
                'texto' => 'Por Vencer',
                'clase' => 'text-yellow-600',
                'dias' => 'Vence en ' . $this->dias_para_vencer . ' días'
            ];
        }

        return [
            'texto' => 'Al Día',
            'clase' => 'text-green-600',
            'dias' => ''
        ];
    }
}
