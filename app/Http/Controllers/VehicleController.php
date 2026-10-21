<?php

// Define a pasta (namespace) onde este arquivo Controller está localizado
namespace App\Http\Controllers;

// Importa o 'Vehicle' para fazer consultas no banco de dados
use App\Models\Vehicle;

// Importa a classe de validação customizada para proteger o formulário
use App\Http\Requests\StoreVehicleRequest;

// Importa a classe nativa do Laravel para manipulação de requisições HTTP
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Exibe a 'listagem' de todos os veículos cadastrados.
     * (Substitui o 'antigo' arquivo 'visualizarVeiculos.php')
     */
    public function index()
    {
        // O Eloquent ORM busca todas as linhas da tabela 'vehicles' no MySQL automaticamente
        $carros = Vehicle::all();
        
        // Abre a view 'index.blade.php' dentro da pasta 'resources/views/vehicles/'
        // O compact('carros') envia a lista de veículos recuperada do banco para dentro da tela
        return view("vehicles.index", compact("carros"));
    }

    /**
     * Exibe o formulário HTML de cadastro para o usuário.
     * (Substitui o antigo 'formularioCadastrarVeiculos.php')
     */
    public function create()
    {
        // Abre a tela 'create.blade.php' dentro da pasta 'resources/views/vehicles/'
        return view("vehicles.create");
    }

    /**
     * Recebe os dados do formulário enviado via POST, limpa, valida e salva no banco de dados.
     * (Substitui o antigo arquivo de processamento 'recFormIserirCarro.php')
     */
    public function store(StoreVehicleRequest $request)
    {

        // O Laravel intercepta a requisição e executa as regras do StoreVehicleRequest primeiro.
        // Se houver algum erro de validação (ex: placa repetida), o código para aqui e volta pro front.
        // O método validated() abaixo recupera apenas as variáveis que passaram 100% no teste.
        $dados = $request->validated();

        // Tratamento idêntico ao do PHP Nativo:
        // 1. Remove o símbolo de cifrão 'R$', os espaços extras e os pontos separadores de milhar
        $precoLimpo = str_replace(["R$", " ", "."], "", $dados["preco"]);

        // 2. Substitui a vírgula decimal por ponto para que o MySQL (padrão americano) aceite o dado como decimal
        $dados["preco"] = str_replace(",", ".", $precoLimpo);

        // O Eloquent ORM cria o registro no MySQL.
        // SE LIGA: Ele já roda o prepared statement por baixo dos panos contra SQL Injection.
        Vehicle::create($dados);

        // Redireciona o navegador de volta para a tela de listagem de carros
        // O ->with() grava uma mensagem temporária ('sucesso') na sessão para ser exibida na tela
        return redirect()->route("vehicles.index")->with("sucesso", "Veículo cadastrado com sucesso!");
    }
}
