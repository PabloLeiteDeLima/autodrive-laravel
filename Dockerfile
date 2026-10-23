FROM richarvey/nginx-php-fpm:latest

COPY . .

ENV DB_CONNECTION=pgsql
ENV DB_PORT=5432


RUN chmod +x /var/www/html/scripts/run.sh

# Configurações para o Render e Laravel
ENV SKIP_COMPOSER 0
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
