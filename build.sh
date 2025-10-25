#!/usr/bin/env bash
set -eux

echo "🚀 Running Laravel build script..."

# Install dependencies if vendor missing
if [ ! -d "vendor" ]; then
    composer install --no-dev --optimize-autoloader
fi

# Generate app key only if not already set
if ! grep -q "APP_KEY=" .env 2>/dev/null; then
    php artisan key:generate --force
fi

# Clear caches
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true
php artisan cache:clear || true

# Rebuild caches for production
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Run database migrations (optional but recommended)
php artisan migrate --force || true

echo "✅ Laravel build finished!"
