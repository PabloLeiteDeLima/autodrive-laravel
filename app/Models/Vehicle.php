<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
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

    /**
     * Accessor do Laravel 11 para formatar o preço com o cifrão automaticamente.
     * Mapeia dinamicamente a propriedade virtual $carro->preco_formatted
     */
    protected function precoFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => 'R$ ' . number_format($this->preco, 2, ',', '.')
        );
    }
}
