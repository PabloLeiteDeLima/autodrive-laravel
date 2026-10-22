<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concessionária - Editar Veículo</title>
    <link rel="stylesheet" href="{{ asset('css/style-formularioCadastrarVeiculos.css') }}" />
</head>
<body>

<div class="container">
    <div class="header-container">
        <div class="header-form">
            <h2>Editar Veículo</h2>
            <p>Altere as informações necessárias e clique em salvar.</p>
        </div>
        <a href="{{ route('vehicles.index') }}" class="btn-visualizar">📋 Voltar ao Estoque</a>
    </div>

    <!-- Bloco de Erros Global (Limpo) -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vehicles.update', $carro->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" id="marca" name="marca" value="{{ old('marca', $carro->marca) }}">
            </div>

            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" id="modelo" name="modelo" value="{{ old('modelo', $carro->modelo) }}">
            </div>

            <div class="form-group">
                <label for="ano">Ano de Fabricação</label>
                <input type="number" id="ano" name="ano" value="{{ old('ano', $carro->ano) }}">
            </div>

            <div class="form-group">
                <label for="placa">Placa</label>
                <!-- Removido o style inline e adicionada a classe input-placa -->
                <input type="text" id="placa" name="placa" class="input-placa" value="{{ old('placa', $carro->placa) }}">
            </div>

            <div class="form-group">
                <label for="cambio">Tipo de Câmbio</label>
                <select id="cambio" name="cambio">
                    <option value="">Selecione...</option>
                    <option value="Manual" {{ old('cambio', $carro->cambio) == 'Manual' ? 'selected' : '' }}>Manual</option>
                    <option value="Automático" {{ old('cambio', $carro->cambio) == 'Automático' ? 'selected' : '' }}>Automático</option>
                    <option value="CVT" {{ old('cambio', $carro->cambio) == 'CVT' ? 'selected' : '' }}>CVT</option>
                </select>
            </div>

            <div class="form-group">
                <label for="preco">Preço (R$)</label>
                <input type="text" id="preco" name="preco" value="{{ old('preco', number_format($carro->preco, 2, ',', '.')) }}">
            </div>

            <div class="form-group full-width">
                <label for="observacao">Observações / Detalhes Adicionais</label>
                <input type="text" id="observacao" name="observacao" value="{{ old('observacao', $carro->observacao) }}">
            </div>
        </div>

        <!-- Removido o style inline e adicionada a classe btn-save -->
        <button type="submit" class="btn-submit btn-save">Salvar Alterações</button>
    </form>
</div>
</body>
</html>
