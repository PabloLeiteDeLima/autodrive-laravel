<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {
        // Altere para true para permitir que usuários autenticados atualizem os dados
        return true; 
    }

    /**
     * As regras de validação que serão aplicadas aos dados do formulário de edição.
     */
    public function rules(): array
    {
        // Captura a instância do veículo que está sendo editado na rota atual
        $vehicle = $this->route('id');
        $vehicleId = $vehicle ? $vehicle->id : null;

        return [
            "marca"      => "required|string|max:50",
            "modelo"     => "required|string|max:50",
            "ano"        => "required|integer|min:1950|max:" . (date("Y") + 1),
            // Ignora o ID do próprio veículo sendo editado na validação de placa única
            "placa"      => "required|string|max:8|unique:vehicles,placa," . $vehicleId,
            "preco"      => "required|string",
            "cambio"     => "required|string|max:15",
            "observacao" => "nullable|string",
            "foto"       => "nullable|image|mimes:jpeg,png,jpg,webp|max:2048", // adcionando validação para o campo da foto.

        ];
    }
}
