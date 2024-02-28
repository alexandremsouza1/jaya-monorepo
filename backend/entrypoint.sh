#!/bin/bash

cd /var/www/html

# Verifica se a pasta vendor não existe antes de executar o comando 'composer install'
if [ ! -d "vendor" ]; then
    composer install --ignore-platform-reqs --no-interaction
fi


php artisan serve --host 0.0.0.0 --port 8000 --env dev