#!/bin/bash
set -e

# Ensure .env exists
if [ ! -f .env ]; then
    echo ".env file not found! Exiting..."
    exit 1
fi

# Generate app key if not set
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

# Run migrations only if DB is reachable
# Uncomment after setting correct DB_HOST and credentials
# php artisan migrate --force

echo "Laravel build script completed successfully."
