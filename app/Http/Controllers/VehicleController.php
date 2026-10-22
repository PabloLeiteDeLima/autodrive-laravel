<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest; // Importação da nova Request de Edição
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;

class VehicleController extends Controller
{
    /**
     * Exibe a listagem de todos os veículos cadastrados.
     */
    public function index(): View
    {
        // Busca os veículos ordenados pelos últimos cadastrados (Melhor performance e UX)
        $carros = Vehicle::latest()->get();
        
        return view("vehicles.index", compact("carros"));
    }

    /**
     * Exibe o formulário HTML de cadastro para o usuário.
     */
    public function create(): View
    {
        return view("vehicles.create");
    }

    /**
     * Recebe os dados do formulário enviado via POST, processa a foto e salva no banco de dados.
     */
    public function store(StoreVehicleRequest $request): RedirectResponse
    {
        $dados = $request->validated();

        // Processamento e Upload da Foto
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $imagem = $request->file('foto');
            $nomeImagem = time() . '.' . $imagem->getClientOriginalExtension();
            
            // Grava na pasta public/uploads/vehicles
            $imagem->move(public_path('uploads/vehicles'), $nomeImagem);
            $dados['foto'] = $nomeImagem;
        }

        // Tratamento e higienização do preço
        $precoLimpo = str_replace(["R$", " ", "."], "", $dados["preco"]);
        $dados["preco"] = str_replace(",", ".", $precoLimpo);

        // Cria o registro via Mass Assignment
        Vehicle::create($dados);

        return redirect()->route("vehicles.index")->with("sucesso", "Veículo cadastrado com sucesso!");
    }

    /**
     * Exibe o formulário de edição preenchido com os dados do veículo utilizando Route Model Binding.
     */
    public function edit(Vehicle $vehicle): View
    {
        // Renomeado internamente para "carro" para manter compatibilidade perfeita com a sua view edit.blade.php
        $carro = $vehicle;

        return view("vehicles.edit", compact("carro"));
    }

    /**
     * Recebe os dados alterados e atualiza o veículo utilizando uma Request customizada.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle): RedirectResponse
    {
        $dados = $request->validated();

        // Tratamento e higienização do preço
        $precoLimpo = str_replace(["R$", " ", "."], "", $dados["preco"]);
        $dados["preco"] = str_replace(",", ".", $precoLimpo);

        // Atualiza os dados no banco
        $vehicle->update($dados);

        return redirect()->route("vehicles.index")->with("sucesso", "Veículo atualizado com sucesso!");
    }

    /**
     * Remove o veículo do banco de dados e apaga o arquivo físico da foto associada se houver.
     */
    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        // Boas práticas extras: Se o carro tinha foto, remove o arquivo físico da pasta uploads
        if ($vehicle->foto && File::exists(public_path('uploads/vehicles/' . $vehicle->foto))) {
            File::delete(public_path('uploads/vehicles/' . $vehicle->foto));
        }

        $vehicle->delete();

        return redirect()->route("vehicles.index")->with("sucesso", "Veículo excluído com sucesso!");
    }
}
