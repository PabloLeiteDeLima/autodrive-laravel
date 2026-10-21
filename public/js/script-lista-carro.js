/* ==========================================================================
   SCRIPT DE LÓGICA E INTERAÇÃO DO ESTOQUE
   ========================================================================== */

document.addEventListener("DOMContentLoaded", function () {
    const searchBar = document.getElementById("searchBar");
    
    // Filtro de Busca em Tempo Real na Tabela
    if (searchBar) {
        searchBar.addEventListener("keyup", function () {
            const value = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll(".dados-tabela tbody tr");

            rows.forEach(row => {
                // Ignora a linha de "Nenhum veículo cadastrado" se ela existir no estoque vazio
                if (row.cells.length > 1) {
                    const textoLinha = row.textContent.toLowerCase();
                    
                    // Se o texto digitado estiver em qualquer parte da linha, mantém visível
                    if (textoLinha.includes(value)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }
            });
        });
    }
});
