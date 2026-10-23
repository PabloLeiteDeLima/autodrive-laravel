FROM richarvey/nginx-php-fpm:latest

# Configurações básicas de ambiente para o Laravel e Nginx
ENV WEBROOT=/var/www/html/public
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1
ENV COMPOSER_ALLOW_SUPERUSER=1

COPY . .

# 1. Instala as dependências do PHP (Gera a pasta vendor)
RUN composer install --no-dev --optimize-autoloader

# 2. Instala o Node.js e compila o Tailwind CSS via Vite (Resolve o design quebrado)
RUN apk add --no-cache nodejs npm \
    && npm install \
    && npm run build

# 3. Força as variáveis de conexão com o banco PostgreSQL
ENV DB_CONNECTION=pgsql
ENV DB_PORT=5432

# 4. Configura as permissões do script de inicialização do Render
RUN chmod +x /var/www/html/scripts/run.sh

CMD ["/start.sh"]
