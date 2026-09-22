<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    protected $fillable = [
        'creditos_id',
        'fecha_pago',
        'monto10',
        'numero_ticket', // <--- Agregado para permitir la asignación masiva
        'referencia',
        'observaciones',
    ];

    public function credito()
    {
        return $this->belongsTo(Credito::class, 'creditos_id');
    }
}