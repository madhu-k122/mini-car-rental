#!/bin/bash
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
