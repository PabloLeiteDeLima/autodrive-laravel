<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concessionária - Cadastrar Veículo</title>
    <!-- O asset() aponta diretamente para o arquivo CSS correto na pasta public -->
    <link rel="stylesheet" href="{{ asset('css/style-formularioCadastrarVeiculos.css') }}" />
</head>
<body>

<div class="container">
    <div class="header-container">
        <div class="header-form">
            <h2>Cadastrar Novo Veículo</h2>
            <p>Preencha os dados abaixo para incluir o veículo no estoque.</p>
        </div>
        <!-- Link para voltar ao estoque usando a rota nomeada do Laravel -->
        <a href="{{ route('vehicles.index') }}" class="btn-visualizar">📋 Visualizar Estoque</a>
    </div>

    <!-- Bloco de Erros Global se a validação falhar -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário com enctype ativado para upload de arquivos -->
    <form action="{{ route('vehicles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-grid">
            <!-- Campo Marca -->
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" id="marca" name="marca" placeholder="Ex: Toyota" value="{{ old('marca') }}">
            </div>

            <!-- Campo Modelo -->
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" id="modelo" name="modelo" placeholder="Ex: Corolla" value="{{ old('modelo') }}">
            </div>

            <!-- Campo Ano -->
            <div class="form-group">
                <label for="ano">Ano de Fabricação</label>
                <input type="number" id="ano" name="ano" placeholder="Ex: 2023" value="{{ old('ano') }}">
            </div>

            <!-- Campo Placa -->
            <div class="form-group">
                <label for="placa">Placa</label>
                <!-- Removido o style inline e adicionada a classe input-placa -->
                <input type="text" id="placa" name="placa" class="input-placa" placeholder="Ex: ABC1D23" value="{{ old('placa') }}">
            </div>

            <!-- Campo Câmbio -->
            <div class="form-group">
                <label for="cambio">Tipo de Câmbio</label>
                <select id="cambio" name="cambio">
                    <option value="">Selecione...</option>
                    <option value="Manual" {{ old('cambio') == 'Manual' ? 'selected' : '' }}>Manual</option>
                    <option value="Automático" {{ old('cambio') == 'Automático' ? 'selected' : '' }}>Automático</option>
                    <option value="CVT" {{ old('cambio') == 'CVT' ? 'selected' : '' }}>CVT</option>
                </select>
            </div>

            <!-- Campo Preço -->
            <div class="form-group">
                <label for="preco">Preço (R$)</label>
                <input type="text" id="preco" name="preco" placeholder="Ex: R$ 85.000,00" value="{{ old('preco') }}">
            </div>

            <!-- Campo de Upload da Foto -->
            <div class="form-group">
                <label for="foto">Foto do Veículo</label>
                <input type="file" id="foto" name="foto" accept="image/*">
            </div>

            <!-- Campo Observações (Ocupa a linha inteira) -->
            <div class="form-group full-width">
                <label for="observacao">Observações / Detalhes Adicionais</label>
                <input type="text" id="observacao" name="observacao" placeholder="Ex: Único dono, teto solar..." value="{{ old('observacao') }}">
            </div>
        </div>

        <button type="submit" class="btn-submit">Cadastrar Veículo</button>
    </form>
</div>

<script src="{{ asset('js/mascaras.js') }}"></script>

</body>
</html>
