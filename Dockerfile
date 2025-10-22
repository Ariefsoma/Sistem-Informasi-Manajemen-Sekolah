FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev curl sqlite3 \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip gd

# Enable Apache modules
RUN a2enmod rewrite

# Copy project
COPY . /var/www/html

# Set proper working directory
WORKDIR /var/www/html

# Apache config
COPY ./apache/laravel.conf /etc/apache2/sites-available/000-default.conf

# Permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Composer install
RUN composer install --no-dev --optimize-autoloader

# Laravel setup
RUN php artisan key:generate || true
RUN php artisan migrate --force || true
RUN php artisan storage:link || true
RUN php artisan config:clear || true
RUN php artisan route:clear || true

EXPOSE 80
CMD ["apache2-foreground"]
