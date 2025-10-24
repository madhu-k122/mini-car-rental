# Use official PHP image with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy all project files
COPY . /var/www/html/

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies (no dev)
RUN composer install --no-dev --optimize-autoloader

# Ensure storage and cache folders exist
RUN mkdir -p /var/www/html/storage/logs /var/www/html/bootstrap/cache

# Fix permissions for Laravel folders
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Update Apache DocumentRoot to point to Laravel's public folder
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Copy and run optional build script (if it exists)
COPY build.sh /usr/local/bin/build.sh
RUN chmod +x /usr/local/bin/build.sh || true
RUN [ -f /usr/local/bin/build.sh ] && /usr/local/bin/build.sh || echo "No build script found"

# Expose port 80
EXPOSE 80

# Set proper user (some environments need this)
USER www-data

# Start Apache
CMD ["apache2-foreground"]
