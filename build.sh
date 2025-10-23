#!/bin/bash

# 1. Install composer dependencies (production)
composer install --no-dev --optimize-autoloader

# 2. Generate APP_KEY if not set
php artisan key:generate --force

# 3. Clear caches to pick up environment variables
php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan view:clear

# 4. Rebuild caches for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Run database migrations safely
php artisan migrate --force

echo "Laravel build script completed successfully."
