FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip git unzip libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

COPY . /var/www/html
WORKDIR /var/www/html

# Ubah document root ke folder public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Aktifkan mod_rewrite
RUN a2enmod rewrite

# Tambahkan konfigurasi Laravel
RUN echo 'ServerName localhost\n\
<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
    DirectoryIndex index.php\n\
</Directory>' >> /etc/apache2/apache2.conf

# Pastikan .htaccess terbaca
RUN chmod 644 /var/www/html/public/.htaccess

EXPOSE 80
CMD ["apache2-foreground"]
