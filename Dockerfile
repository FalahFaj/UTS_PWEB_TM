# Gunakan image resmi PHP dengan server Apache
FROM php:8.1-apache

# Set direktori kerja di dalam container
WORKDIR /var/www/html

# Install dependensi sistem yang dibutuhkan (git, zip) dan ekstensi PHP untuk PostgreSQL
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer (manajer dependensi PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin semua file proyek Anda ke dalam container
COPY . /var/www/html/

# Jalankan composer install untuk mengunduh vendor (seperti phpdotenv)
RUN composer install --no-dev --optimize-autoloader

# Konfigurasi Apache untuk mengarahkan semua request ke index.php (Front Controller Pattern)
RUN a2enmod rewrite && \
    echo '<Directory /var/www/html>' > /etc/apache2/conf-available/routing.conf && \
    echo '    RewriteEngine On' >> /etc/apache2/conf-available/routing.conf && \
    echo '    RewriteCond %{REQUEST_FILENAME} !-f' >> /etc/apache2/conf-available/routing.conf && \
    echo '    RewriteCond %{REQUEST_FILENAME} !-d' >> /etc/apache2/conf-available/routing.conf && \
    echo '    RewriteRule ^ /index.php [L]' >> /etc/apache2/conf-available/routing.conf && \
    echo '</Directory>' >> /etc/apache2/conf-available/routing.conf && \
    a2enconf routing

# Pastikan folder uploads bisa ditulis oleh server
RUN chown -R www-data:www-data /var/www/html/assets/img/uploads