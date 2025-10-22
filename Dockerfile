FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev curl \
    && docker-php-ext-install pdo_mysql pdo_sqlite zip gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . /var/www/html

WORKDIR /var/www/html

# Set Apache to serve Laravel's public folder
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Prepare SQLite database file
RUN touch /var/www/html/database/database.sqlite

# Generate app key & run migrations
RUN php artisan key:generate
RUN php artisan migrate --force
RUN php artisan storage:link || true

# Expose port
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
