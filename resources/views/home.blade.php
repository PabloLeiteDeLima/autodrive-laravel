<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoDrive - Vitrine de Veículos</title>
    <link rel="stylesheet" href="{{ asset('css/style-home.css') }}" />
</head>
<body>

    <!-- Menu de Navegação Superior -->
    <nav class="navbar">
        <a href="{{ url('/') }}" class="navbar-brand">🚗 AutoDrive</a>
        <div class="navbar-menu">
            <a href="{{ url('/') }}">Home</a>
            <a href="#">Quem Somos</a>
            
            <!-- Botão Inteligente: Se estiver logado mostra Painel, se não, mostra Acesso -->
            @auth
                <a href="{{ route('vehicles.index') }}" class="btn-acesso">📋 Painel Estoque</a>
            @else
                <a href="{{ route('login') }}" class="btn-acesso">🔒 Acesso</a>
            @endauth
        </div>
    </nav>

    <!-- Conteúdo Principal do Site -->
    <div class="main-container">
        <div class="titulo-vitrine">
            <h1>Nosso Estoque Disponível</h1>
            <p>Encontre o carro dos seus sonhos com as melhores condições do mercado.</p>
        </div>

        <!-- Grid de Cards ("Quadradinhos") -->
        <div class="vehicles-grid">
            @foreach($carros as $carro)
                <div class="vehicle-card">
                    
                    <!-- LÓGICA DA FOTO REAL DO BANCO DE DADOS -->
                    @if($carro->foto)
                        <!-- Se o carro tiver foto cadastrada, puxa ela da pasta pública -->
                        <img src="{{ asset('uploads/vehicles/' . $carro->foto) }}" alt="Foto de {{ $carro->modelo }}" class="vehicle-image">
                    @else
                        <!-- Se não tiver foto, usa uma imagem bonita padrão da internet -->
                        <img src="https://unsplash.com" alt="Foto padrão" class="vehicle-image">
                    @endif
                    
                    <!-- Dados do veículo embaixo da foto -->
                    <div class="vehicle-info">
                        <div class="vehicle-brand">{{ $carro->marca }}</div>
                        <div class="vehicle-title">{{ $carro->modelo }}</div>
                        
                        <div class="vehicle-details">
                            <span>📅 {{ $carro->ano }}</span>
                            <span>⚙️ {{ $carro->cambio }}</span>
                        </div>
                        
                        <div class="vehicle-price">R$ {{ number_format($carro->preco, 2, ',', '.') }}</div>
                    </div>
                </div>
            @endforeach

            <!-- Caso não tenha nenhum veículo no banco -->
            @if($carros->isEmpty())
                <div class="no-vehicles">
                    <p>No momento, não temos veículos em exposição na nossa vitrine virtual.</p>
                </div>
            @endif
        </div>
    </div>

</body>
</html>
