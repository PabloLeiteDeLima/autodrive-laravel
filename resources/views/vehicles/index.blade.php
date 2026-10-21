<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concessionária - Estoque de Veículos</title>
    <link rel="stylesheet" href="{{ asset('css/style-visualizarVeiculos.css') }}" />
</head>
<body>

<div class="container">
    <div class="header-container">
        <div class="header-form">
            <h2>Estoque de Veículos</h2>
            <p>Consulte, edite ou remova os carros cadastrados no sistema.</p>
        </div>
    </div>

    <!-- Alerta de Sucesso -->
    @if(session('sucesso'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 5px; font-weight: 600;">
            {{ session('sucesso') }}
        </div>
    @endif

    <div class="table-actions">
        <input type="text" id="searchBar" placeholder="🔍 Buscar modelo...">
        <a href="{{ route('vehicles.create') }}" class="btn-add">+ Cadastrar Novo</a>
    </div>

    <div class="table-responsive">
        <table class="dados-tabela">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Ano</th>
                    <th>Placa</th>
                    <th>Câmbio</th>
                    <th>Preço</th>
                    <th>Observações</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
    
    @foreach($carros as $carro)
                <tr>
                    <td>{{ $carro->id }}</td>
                    <td><span class="badge-marca">{{ $carro->marca }}</span></td>
                    <td><strong>{{ $carro->modelo }}</strong></td>
                    <td>{{ $carro->ano }}</td>
                    <td class="text-uppercase">{{ $carro->placa }}</td>
                    <td>{{ $carro->cambio }}</td>
                    <td class="text-preco">R$ {{ number_format($carro->preco, 2, ',', '.') }}</td>
                    <td class="text-obs">{{ $carro->observacao }}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{ route('vehicles.edit', $carro->id) }}" class="btn-action btn-edit" title="Editar">✏️</a>

                            <form action="{{ route('vehicles.destroy', $carro->id) }}" method="POST" style="display:inline;"
                                  onsubmit="return confirm('Tem certeza que deseja excluir o veículo {{ $carro->modelo }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" style="background:none; border:none; cursor:pointer;" title="Excluir">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
    @endforeach

    @if($carros->isEmpty())
                <tr>
                    <td colspan="9" class="text-center" style="padding: 20px;">Nenhum veículo cadastrado no estoque.</td>
                </tr>
    @endif
            </tbody>
        </table>
    </div>
</div>

<script src="{{ asset('js/script-lista-carro.js') }}" defer></script>
</body>
</html>
