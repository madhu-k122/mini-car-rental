#!/bin/bash

# Exit on any failure
set -e

echo "Running Laravel build script..."

# Install composer dependencies
composer install --no-dev --optimize-autoloader

# Generate app key if not exists
php artisan key:generate

# Clear caches
php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan view:clear

# Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

echo "Laravel build script completed successfully."
