# Gunakan versi PHP dengan Apache & Debian Bullseye (lebih stabil)
FROM php:8.2-apache-bullseye

# Install dependencies sistem
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpng-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    pkg-config \
    libsqlite3-dev \
    sqlite3 \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Atur direktori kerja
WORKDIR /var/www/html

# Copy source code ke container
COPY . .

# Install composer dari official image
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Install dependency Laravel
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permission agar storage bisa ditulis
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Aktifkan mod_rewrite untuk Laravel routing
RUN a2enmod rewrite
RUN echo "<Directory /var/www/html>\n\
    AllowOverride All\n\
</Directory>" > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

# Expose port 80
EXPOSE 80

# Jalankan Apache
CMD ["apache2-foreground"]
