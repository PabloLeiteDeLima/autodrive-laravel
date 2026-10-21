<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';
    protected $primaryKey = 'id';

    protected $fillable = [
        'marca',
        'modelo',
        'ano', 
        'placa',
        'preco',
        'cambio',
        'observacao'
    ];
}
