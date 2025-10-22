# Gunakan image PHP dengan Apache
FROM php:8.2-apache-bullseye

# Install dependencies
RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev curl sqlite3 \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy semua file ke container
WORKDIR /var/www/html
COPY . .

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Install dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# Pastikan folder storage dan bootstrap/cache bisa ditulis
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Jalankan Apache
CMD ["apache2-foreground"]
