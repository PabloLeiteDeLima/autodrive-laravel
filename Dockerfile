FROM php:8.2-fpm

# Instala dependências do sistema e extensões PHP necessárias para o PostgreSQL e Laravel
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql

# Busca o binário oficial do Node.js e do NPM de uma imagem oficial (Rápido e sem erros de apt-get)
COPY --from=node:18 /usr/local/bin/node /usr/local/bin/node
COPY --from=node:18 /usr/local/lib/node_modules /usr/local/lib/node_modules
RUN ln -s /usr/local/bin/node /usr/local/bin/usr && ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/view

# Copia os arquivos do projeto
COPY . .

# Instala as dependências do Composer para produção
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Instala as dependências do Node e compila os arquivos de CSS/JS (Vite)
RUN npm install && npm run build

# Ajusta as permissões para o Laravel
RUN chown -R www-data:www-data /var/view/storage /var/view/bootstrap/cache

# Expõe a porta dinâmica do Render
EXPOSE 8000

# Executa as migrações em produção e depois inicia o servidor embutido do PHP
# CMD php artisan migrate --force && php artisan config:clear && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
CMD php artisan migrate --force --seed && php artisan config:clear && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
