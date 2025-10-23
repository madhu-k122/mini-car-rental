#!/bin/bash

# Increase memory limit for Composer
export COMPOSER_MEMORY_LIMIT=-1

# Clear Composer cache
composer clear-cache

# Install dependencies
composer install --no-dev --optimize-autoloader --prefer-dist --no-interaction

# Generate app key if missing
php artisan key:generate --force

# Clear caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (if DB is accessible)
php artisan migrate --force

echo "Laravel build completed successfully."
