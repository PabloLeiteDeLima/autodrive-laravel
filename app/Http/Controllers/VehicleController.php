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

    /**
     * Remove o veículo do banco de dados.
     * (Substitui o 'deletarCarro.php')
     */
    public function destroy (int $id){

        // 1. Busca o vehicle pelo ID.
        // O método findOrFail lança automaticamente um erro 404 (Não Encontrado) se o ID não existir.
        $carro = Vehicle::findOrFail($id);

        // 2. Execulta o delete por baixo dos panos
        $carro->delete();

        // 3. Redirecionamento para tela de listagem de veículos.
        // Enviar uma mensagem de sucesso.
        return redirect()->route("vehicle.index")->with("sucesso", "Veículo excluído com sucesso!");
    }

    /**
     * Exibe o formulário de edição preenchido com os dados do veículo.
     * (Substitui o 'formularioAtualizarVeiculo.php')
     */
    public function edit(int $id)
    {
        // 1. Busca o vehicle pelo ID.
        // O método findOrFail lança automaticamente um erro 404 (não encontrado) se o ID não existir.
        $carro = Vehicle::findOrFail($id);

        // 2. Abre a view 'edit.blade.php' dentro da pasta 'resources/views/vehicles/'
        // Envia os dados do veículo encontrado para preencher os inputs do formulário.
        return view("vehicles.edit", compact("carro"));
    }

    /**
     * Recebe os dados alterados do formulário e o ID do veículo.
     */
    public function update(Request $request,int $id)
    {
        // 1. Bunsca o vehicle que será atualizada.
        $carro = Vehicle::findOrFail($id);

        // 2. Validando os dados do formulário (atualizar)
        $dados = $request->validate([
            "marca"         => "requered|string|max:50",
            "modelo"        => "required| string|max:50",
            "ano"           => "required|integer|min:1950|max: " . (date("Y") + 1),
            "placa"         => "required|string|max:8|unique:vehicles,placa," . $carro->id,
            "preco"         => "required|string",
            "cambio"        => "required|string|max:15",
            "observacao"    => "nullable|string",
        ]);

        // 3. Tratando o preço.
        // Removendo 'R$' , espaços e ponto.
        $precoLimpo = str_replace(["R$", " ", "."], "", $dados["preco"]);
        // Subistituindo a vírgula pelo ponto.
        $dados["preco"] = str_replace(",", ".", $precoLimpo);

        // 4. Atualizar os dadso do veiculo no banco 
        $carro->update($dados);

        // 5. Redirecionamento de pagina para listagem de veiculs.
        return redirect()->route("vehicles.index")->with("sucesso", "Veículo Atualizado com sucesso!!!");
    }// fechando a função update().

}
