#!/bin/bash

# Install composer dependencies
composer install --no-dev --optimize-autoloader

# Generate key if missing
php artisan key:generate --force

# Clear old caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

echo "Laravel build completed successfully."
