<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Contracts\View\View;

class SiteController extends Controller
{
    /**
     * Exibe a página inicial pública da concessionária (Vitrine de Carros).
     */
    public function home(): View
    {
        // Busca os veículos ordenados pelos últimos cadastrados
        $carros = Vehicle::latest()->get();

        // Abre a view dentro de uma pasta organizada (ex: resources/views/site/home.blade.php)
        // Se você ainda mantém o arquivo direto na raiz, use apenas view('home', compact('carros'))
        return view('home', compact('carros'));
    }

    /**
     * Exibe a página "Quem Somos".
     */
    public function quemSomos(): View
    {
        return view('quem-somos');
    }
}
