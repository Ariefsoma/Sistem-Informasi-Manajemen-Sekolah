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

# Set permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate app key & migrate database
RUN php artisan key:generate || true
RUN php artisan migrate --force || true
RUN php artisan storage:link || true

# Copy Apache config
COPY ./apache/laravel.conf /etc/apache2/sites-available/000-default.conf

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]

