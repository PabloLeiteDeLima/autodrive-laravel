<?php

use Illuminate\Support\Facades\Route;
// Importando os dois Controllers que o nosso sistema possui
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\SiteController;

/*
|--------------------------------------------------------------------------
| Rotas do Site Público (Vitrine)
|--------------------------------------------------------------------------
*/

// Rota da Página Inicial (Acessa a vitrine de quadradinhos chamando a função 'home')
Route::get('/', [SiteController::class, 'home'])->name('site.home');

// Rota da Página Quem Somos
Route::get('/quem-somos', [SiteController::class, 'quemSomos'])->name('site.quem-somos');


/*
|--------------------------------------------------------------------------
| Rotas do Painel Administrativo PROTEGIDAS POR SENHA (CRUD)
|--------------------------------------------------------------------------
| O ->middleware('auth') garante que se alguém tentar acessar essas URLs 
| sem estar logado, será expulso automaticamente para a tela de login.
*/
Route::middleware('auth')->group(function () {

    // Rota para Listar todos os veículos no painel administrativo.
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');

    // Rota para Exibir o formulário de cadastro.
    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');

    // Rota para Receber e Salvar o novo veículo (enviada via POST em /vehicles)
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');

    // Rota para Exibir o formulário de edição trazendo o ID do carro na URL
    Route::get('/vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');

    // Rota para Salvar as alterações da edição no banco de dados (Método PUT)
    Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('vehicles.update');

    // Rota para Deletar um veículo do banco de dados usando o ID (Método DELETE)
    Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

});

// Carrega as rotas automáticas de login/cadastro que o Breeze criou
require __DIR__.'/auth.php';
