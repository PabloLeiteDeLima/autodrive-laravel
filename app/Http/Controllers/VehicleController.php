<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
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

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $imagem = $request->file('foto');
            $nomeImagem = time() . '.' . $imagem->getClientOriginalExtension();
            
            $imagem->move(public_path('uploads/vehicles'), $nomeImagem);
            $dados['foto'] = $nomeImagem;
        }

        $precoLimpo = str_replace(["R$", " ", "."], "", $dados["preco"]);
        $dados["preco"] = str_replace(",", ".", $precoLimpo);

        Vehicle::create($dados);

        return redirect()->route("vehicles.index")->with("sucesso", "Veículo cadastrado com sucesso!");
    }

    /**
     * Exibe o formulário de edição preenchido com os dados do veículo.
     * Alterado de $vehicle para $id para bater com o {id} configurado na sua rota.
     */
    public function edit(Vehicle $id): View
    {
        $carro = $id;
        return view("vehicles.edit", compact("carro"));
    }

    /**
     * Recebe os dados alterados e atualiza o veículo utilizando uma Request customizada.
     * Alterado de $vehicle para $id para bater com o {id} configurado na sua rota.
     */
        /**
     * Recebe os dados alterados e atualiza o veículo com suporte a nova foto.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $id): RedirectResponse
    {
        $dados = $request->validated();

        // Processamento e Upload de Nova Foto na Edição
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            // 1. Apaga a foto antiga do servidor se ela existir
            if ($id->foto && File::exists(public_path('uploads/vehicles/' . $id->foto))) {
                File::delete(public_path('uploads/vehicles/' . $id->foto));
            }

            // 2. Sobe a nova foto com nome único
            $imagem = $request->file('foto');
            $nomeImagem = time() . '.' . $imagem->getClientOriginalExtension();
            $imagem->move(public_path('uploads/vehicles'), $nomeImagem);
            
            // 3. Atualiza o nome do arquivo no array de dados
            $dados['foto'] = $nomeImagem;
        }

        // Tratamento e higienização do preço
        $precoLimpo = str_replace(["R$", " ", "."], "", $dados["preco"]);
        $dados["preco"] = str_replace(",", ".", $precoLimpo);

        // Atualiza os dados no banco
        $id->update($dados);

        return redirect()->route("vehicles.index")->with("sucesso", "Veículo atualizado com sucesso!");
    }


    /**
     * Remove o veículo do banco de dados e apaga o arquivo físico da foto associada se houver.
     * Alterado de $vehicle para $id para bater com o {id} configurado na sua rota.
     */
    public function destroy(Vehicle $id): RedirectResponse
    {
        if ($id->foto && File::exists(public_path('uploads/vehicles/' . $id->foto))) {
            File::delete(public_path('uploads/vehicles/' . $id->foto));
        }

        $id->delete();

        return redirect()->route("vehicles.index")->with("sucesso", "Veículo excluído com sucesso!");
    }
}
