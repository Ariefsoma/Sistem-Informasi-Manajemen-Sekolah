# Gunakan image dasar PHP dengan Apache
FROM php:8.2-apache

# Install ekstensi dan dependency yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libpng-dev libxml2-dev libsqlite3-dev curl \
    && docker-php-ext-install pdo_mysql pdo_sqlite zip gd

# Aktifkan mod_rewrite untuk Laravel route
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy semua file project Laravel ke dalam container
COPY . /var/www/html

# Set permission untuk folder penting Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install dependency PHP Laravel (tanpa dev)
RUN composer install --no-dev --optimize-autoloader

# Generate APP_KEY (abaikan error jika sudah ada)
RUN php artisan key:generate || true

# Jalankan migration database (abaikan error jika sudah ada)
RUN php
