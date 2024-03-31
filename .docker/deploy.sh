#!/bin/sh
set -e

echo '------ Iniciando tarefas de deploy  ------'

# Refresh cache
php artisan config:cache
php artisan view:cache

echo '------ Concluído ------'
