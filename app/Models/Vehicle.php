<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    // Habilita o uso de Factories para testes automatizados (Super valorizado!)
    use HasFactory;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'marca',
        'modelo',
        'ano', 
        'placa',
        'preco',
        'cambio',
        'observacao',
        'foto' 
    ];
}
