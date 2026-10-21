<?php

use Illuminate\Support\Facades\Route;
// Importando o controller.
use App\Http\Controllers\VehicleController;

Route::get('/', function(){
    return view('welcome');
});

// Rotas para o CRUD.
// O ->name() é um "apelido" para a rota, facilitando chamá-lo no html.

// Rota para Listar todos os veículos. (ADICIONE ESTA LINHA ABAIXO)
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');

// Rota para Exibir o formulário de cadastro.
Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');

// Rota para Receber e Salvar o novo veículo (enviada via POST em /vehicles)
Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');

// Rota para Exibir o formulário de edição trazendo o ID do carro na URL (ex: /vehicles/4/edit)
Route::get('/vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');

// Rota para Salvar as alterações da edição no banco de dados (SE LIGA: Usando o método PUT por SEGURANÇA.)
Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('vehicles.update');

// Rota para Deletar um veículo do banco de dados usando o ID (SE LIGA: Usando o método DELETE)
Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
