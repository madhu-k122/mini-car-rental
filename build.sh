#!/bin/bash

cd /var/www/html

# 1. Install composer dependencies (production)
composer install --no-dev --optimize-autoloader

# 2. Generate APP_KEY if not set
php artisan key:generate --force

# 3. Clear caches
php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan view:clear

# 4. Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Run migrations
php artisan migrate --force

echo "Laravel build script completed successfully."
