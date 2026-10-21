# 🚗 AutoDrive - Sistema de Gerenciamento de Veículos (Versão Laravel)

O **AutoDrive** é um sistema para gerenciamento de estoque de veículos de uma concessionária. Este projeto foi originalmente desenvolvido por mim em PHP Nativo (com POO, PDO e MVC do zero) e agora foi **migrado para o ecossistema Laravel 11** com o objetivo de aplicar padrões modernos de mercado e aumentar a escalabilidade da aplicação.

---

## 🚀 Tecnologias Utilizadas

### Backend & Banco de Dados
* **PHP 8.2+** como linguagem do servidor.
* **Laravel Framework** para padronização de arquitetura.
* **Eloquent ORM** substituindo a camada antiga de DAO para persistência segura de dados.
* **MySQL** para gerenciamento de banco de dados relacional (via XAMPP).

### Frontend (Desenvolvido em parceria com I.A)
* **HTML5 & CSS3** com design responsivo.
* **JavaScript (Vanilla)** para validações em tempo real e máscaras dinâmicas (Moeda R\$ e Placas).

---

## 🛡️ Segurança & Boas Práticas Aplicadas

* **Form Requests:** Toda a validação que antes era feita com condicionais estruturadas foi isolada em classes de validação nativas do Laravel, garantindo código limpo no Controller.
* **Proteção XSS nativa:** Uso dos componentes Blade `{{ }}` para renderização segura de strings em tela.
* **Proteção CSRF:** Formulários blindados com tokens de segurança contra falsificação de requisições transfronteiriças.
* **Migrations & Seeders:** Controle de versão do banco de dados completo para fácil replicação do ambiente de desenvolvimento.

---

## 💻 Como Executar o Projeto Localmente

### Pré-requisitos
* PHP 8.2 ou superior
* Composer instalado
* XAMPP (Apache e MySQL iniciados)

### Passo a Passo

1. **Clone o repositório:**
   ```bash
   git clone https://github.com
   cd autodrive-laravel
   ```

2. **Instale as dependências do projeto:**
   ```bash
   composer install
   ```

3. **Configure as variáveis de ambiente:**
   * Duplique o arquivo `.env.example` e mude o nome da cópia apenas para `.env`.
   * Configure as credenciais do seu banco de dados MySQL do XAMPP dentro do `.env` (usuário `root` e senha vazia).

4. **Gere a chave da aplicação:**
   ```bash
   php artisan key:generate
   ```

5. **Rode as Migrations (Criar as tabelas no banco):**
   ```bash
   php artisan migrate
   ```

6. **Inicie o servidor local:**
   ```bash
   php artisan serve
   ```
   O projeto estará rodando em `http://127.0.0.1:8000`.

---

## 📩 Contato (Aberto para dicas e sugestões)
"Acredito que essa é uma maneira de crescimento tanto para quem aprende quanto para quem ensina."

* **Desenvolvedor:** Pablo Leite de Lima
* **LinkedIn:** [https://linkedin.com](https://linkedin.com)
