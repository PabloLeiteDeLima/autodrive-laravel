FROM php:8.2-fpm

# Instala dependências, extensões PHP e adiciona o Node.js v18 (necessário para o Vite/Mix)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && curl -fsSL https://nodesource.com | bash - \
    && apt-get install -y nodesource-repo nodejs \
    && docker-php-ext-install pdo pdo_pgsql

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/view

# Copia os arquivos do projeto
COPY . .

# Instala as dependências do Composer para produção
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Instala os pacotes do Node e compila os arquivos CSS e JS para produção
RUN npm install && npm run build

# Ajusta as permissões para o Laravel
RUN chown -R www-data:www-data /var/view/storage /var/view/bootstrap/cache

# Expõe a porta dinâmica do Render
EXPOSE 8000

# Executa as migrações em produção e depois inicia o servidor embutido do PHP
CMD php artisan migrate --force && php artisan config:clear && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
