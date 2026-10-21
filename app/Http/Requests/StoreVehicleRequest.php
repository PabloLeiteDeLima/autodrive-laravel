<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Tem que esta true para liberar o formulário.
    }

    public function rules(): array
    {
        return [
            "marca" => "required|string|max:50",
            "modelo" => "required|string|max:50",
            "ano" => "required|integer|min:1900|max:" . (date("Y") + 1),
            "placa" => "required|string|max:10|unique:vehicles,placa",
            "preco" => "required|string",
            "cambio" => "required|string|max:30",
            "observacao" => "nullable|string",
        ];
    }
}
