<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concessionária - Cadastrar Veículo</title>
    <link rel="stylesheet" href="{{ asset('css/style-formularioCadastrarVeiculos.css') }}" />
</head>
<body>

<div class="container">
    <div class="header-container">
        <div class="header-form">
            <h2>Cadastrar Novo Veículo</h2>
            <p>Preencha os dados abaixo para incluir o veículo no estoque.</p>
        </div>
        <a href="{{ route('vehicles.index') }}" class="btn-visualizar">📋 Visualizar Estoque</a>
    </div>

    <!-- Erros de Validação -->
    @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 25px; border-radius: 6px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vehicles.store') }}" method="POST">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" id="marca" name="marca" placeholder="Ex: Toyota" value="{{ old('marca') }}">
            </div>

            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" id="modelo" name="modelo" placeholder="Ex: Corolla" value="{{ old('modelo') }}">
            </div>

            <div class="form-group">
                <label for="ano">Ano de Fabricação</label>
                <input type="number" id="ano" name="ano" placeholder="Ex: 2023" value="{{ old('ano') }}">
            </div>

            <div class="form-group">
                <label for="placa">Placa</label>
                <input type="text" id="placa" name="placa" placeholder="Ex: ABC1D23" value="{{ old('placa') }}" style="text-transform: uppercase;">
            </div>

            <div class="form-group">
                <label for="cambio">Tipo de Câmbio</label>
                <select id="cambio" name="cambio">
                    <option value="">Selecione...</option>
                    <option value="Manual" {{ old('cambio') == 'Manual' ? 'selected' : '' }}>Manual</option>
                    <option value="Automático" {{ old('cambio') == 'Automático' ? 'selected' : '' }}>Automático</option>
                    <option value="CVT" {{ old('cambio') == 'CVT' ? 'selected' : '' }}>CVT</option>
                </select>
            </div>

            <div class="form-group">
                <label for="preco">Preço (R$)</label>
                <input type="text" id="preco" name="preco" placeholder="Ex: R$ 85.000,00" value="{{ old('preco') }}">
            </div>

            <div class="form-group full-width">
                <label for="observacao">Observações / Detalhes Adicionais</label>
                <input type="text" id="observacao" name="observacao" placeholder="Ex: Único dono..." value="{{ old('observacao') }}">
            </div>
        </div>

        <button type="submit" class="btn-submit">Cadastrar Veículo</button>
    </form>
</div>
</body>
</html>
