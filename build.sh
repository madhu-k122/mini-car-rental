#!/usr/bin/env bash
set -eux

echo "🚀 Running Laravel build script..."

# Install dependencies if vendor missing
if [ ! -d "vendor" ]; then
    composer install --no-dev --optimize-autoloader
fi

# Ensure .env exists
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Generate app key
php artisan key:generate --force

# Clear old caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Build production caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ensure DB tables exist and run migrations
php artisan migrate --force
php artisan session:table --force
php artisan migrate --force

echo "✅ Laravel build finished!"
