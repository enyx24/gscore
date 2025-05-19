#!/bin/bash

cd /app
composer install
npm install
npm run build
php artisan migrate --seed
php artisan serve --host=0.0.0.0 --port=8000
