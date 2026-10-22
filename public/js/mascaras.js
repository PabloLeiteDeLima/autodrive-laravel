
/*
*MÁSCARAS DE INPUT - FORMULÁRIOS DE VEÍCULOS
*/

document.addEventListener("DOMContentLoaded", function () {
    const precoInput = document.getElementById("preco");

    if (precoInput) {
        precoInput.addEventListener("input", function (e) {
            // 1. Remove tudo o que não for número digitado pelo usuário
            let valor = e.target.value.replace(/\D/g, "");

            // 2. Se o campo estiver vazio, limpa o input
            if (!valor) {
                e.target.value = "";
                return;
            }

            // 3. Converte para o padrão decimal (divide por 100 para criar os centavos)
            valor = (valor / 100).toFixed(2) + "";
            
            // 4. Substitui o ponto decimal por vírgula
            valor = valor.replace(".", ",");

            // 5. Adiciona os pontos de milhar a cada 3 dígitos
            valor = valor.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

            // 6. Devolve o valor formatado com o símbolo da moeda real
            e.target.value = "R$ " + valor;
        });
    }
});
