<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nombres',
        'apellidos',
        'documento_identidad',
        'telefono',
        'correo',
        'direccion',
        'estado',
    ];

    // Un cliente puede tener muchos créditos
    public function creditos()
    {
        return $this->hasMany(Credito::class, 'clientes_id');
    }
}
