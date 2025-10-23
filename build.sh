#!/bin/bash
echo "Running Laravel build script..."

# Create .env from example if missing
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Generate application key
php artisan key:generate --force

# Clear and cache configs
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

echo "Build finished!"
