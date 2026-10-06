<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_identificacion',
        'nombre',
        'apellido',
        'razon_social',
        'cedula',
        'telefono',
        'email',
        'direccion'
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function getNombreCompletoAttribute()
    {
        if ($this->tipo_identificacion === 'NIT') {
            return $this->razon_social;
        }
        return "{$this->nombre} {$this->apellido}";
    }
}
