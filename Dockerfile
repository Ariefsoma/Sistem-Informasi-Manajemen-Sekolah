# Gunakan image resmi PHP + Apache
FROM php:8.2-apache

# Install dependensi yang diperlukan Laravel
RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev curl sqlite3 \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip gd

# Aktifkan mod_rewrite untuk Laravel route
RUN a2enmod rewrite

# Copy semua file ke folder kerja
WORKDIR /var/www/html

COPY . /var/www/html

# Atur permission storage & bootstrap
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Ganti DocumentRoot Apache agar mengarah ke folder public
RUN sed -i 's#/var/www/html#/var/www/html/public#g' /etc/apache2/sites-available/000-default.conf

# Set environment variable default (opsional)
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Expose port 80
EXPOSE 80

# Jalankan Apache di foreground
CMD ["apache2-foreground"]
