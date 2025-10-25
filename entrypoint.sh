#!/usr/bin/env bash
set -eux

# Fix permissions for Laravel folders
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Clear old cached config
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Rebuild config cache using Render env vars
php artisan config:cache || true

# Start Apache in foreground
apache2-foreground
