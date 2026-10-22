/* ==========================================================================
   SCRIPT DE LÓGICA E INTERAÇÃO DO ESTOQUE
   ========================================================================== */

document.addEventListener("DOMContentLoaded", function () {
    const searchBar = document.getElementById("searchBar");
    const deleteForms = document.querySelectorAll('.form-delete');

    // 1. Filtro de Busca em Tempo Real na Tabela
    if (searchBar) {
        searchBar.addEventListener("keyup", function () {
            const value = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll(".dados-tabela tbody tr");

            rows.forEach(row => {
                // Ignora a linha de "Nenhum veículo cadastrado" se ela existir no estoque vazio
                if (row.cells.length > 1) {
                    const textoLinha = row.textContent.toLowerCase();
                    
                    // Se o texto digitado estiver em qualquer parte da linha, mantém visível
                    row.style.display = textoLinha.includes(value) ? "" : "none";
                }
            });
        });
    }

    // 2. Confirmação de Exclusão de Veículos
    if (deleteForms.length > 0) {
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (event) {
                // Pega o nome do modelo do veículo direto do atributo "data-modelo" do HTML
                const modeloCarro = this.getAttribute('data-modelo');
                
                // Exibe a confirmação nativa do navegador
                const certeza = confirm(`Tem certeza que deseja excluir o veículo ${modeloCarro}?`);
                
                // Se o usuário clicar em "Cancelar", impede o envio do formulário para o Laravel
                if (!certeza) {
                    event.preventDefault();
                }
            });
        });
    }
});
