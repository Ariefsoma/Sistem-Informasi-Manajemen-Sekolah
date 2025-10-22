# Gunakan image PHP dengan ekstensi yang dibutuhkan
FROM php:8.2-fpm

# Install dependensi sistem & ekstensi PHP yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libonig-dev libxml2-dev zip curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy semua file ke container
COPY . .

# Install dependensi Laravel
RUN composer install --no-dev --optimize-autoloader

# Set permission agar storage & bootstrap bisa ditulis
RUN chmod -R 775 storage bootstrap/cache

# Jalankan php artisan key:generate saat build
RUN php artisan key:generate

# Jalankan server Laravel di port 8000
CMD php artisan serve --host=0.0.0.0 --port=8000

EXPOSE 8000
