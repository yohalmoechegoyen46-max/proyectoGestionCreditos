<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;

    protected $table = 'creditos';

    protected $fillable = [
        'clientes_id',
        'fecha_otorgamiento',
        'fecha_vencimiento',
        'monto',
        'tasa_interes',
        'plazo',
        'total_credito',
        'saldo',
        'estado',
    ];

    // Relación con el Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clientes_id');
    }
}