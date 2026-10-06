<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'contract_id',
        'numero_cuota',
        'monto',
        'fecha_pago',
        'metodo_pago',
        'referencia',
        'notas',
    ];

    /**
     * Los atributos que deben ser convertidos.
     *
     * @var array
     */
    protected $casts = [
        'fecha_pago' => 'date',
        'monto' => 'decimal:2',
    ];

    /**
     * Obtiene el contrato asociado al pago.
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    /**
     * Scope para filtrar pagos por método de pago
     */
    public function scopeByMetodoPago($query, $metodo)
    {
        return $query->where('metodo_pago', $metodo);
    }

    /**
     * Scope para filtrar pagos por rango de fechas
     */
    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('fecha_pago', [$startDate, $endDate]);
    }

    /**
     * Scope para obtener pagos de un contrato específico
     */
    public function scopeByContract($query, $contractId)
    {
        return $query->where('contract_id', $contractId);
    }

    /**
     * Formatea el monto como moneda
     */
    public function getMontoFormateadoAttribute()
    {
        return '$' . number_format($this->monto, 2, '.', ',');
    }

    /**
     * Obtiene el estado del pago basado en la fecha
     */
    public function getEstadoAttribute()
    {
        return $this->fecha_pago->isPast() ? 'Completado' : 'Pendiente';
    }
}
