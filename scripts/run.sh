#!/bin/bash

# Executa as migrações do banco de dados na inicialização
echo "Rodando as migrações do Laravel..."
php artisan migrate --force
