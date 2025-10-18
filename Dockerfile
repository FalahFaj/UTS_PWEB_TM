FROM php:8.1-apache

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html/

RUN composer install --no-dev --optimize-autoloader

RUN a2enmod rewrite && \
    echo '<Directory /var/www/html>' > /etc/apache2/conf-available/routing.conf && \
    echo '    RewriteEngine On' >> /etc/apache2/conf-available/routing.conf && \
    echo '    RewriteCond %{REQUEST_FILENAME} !-f' >> /etc/apache2/conf-available/routing.conf && \
    echo '    RewriteCond %{REQUEST_FILENAME} !-d' >> /etc/apache2/conf-available/routing.conf && \
    echo '    RewriteRule ^ /index.php [L]' >> /etc/apache2/conf-available/routing.conf && \
    echo '</Directory>' >> /etc/apache2/conf-available/routing.conf && \
    a2enconf routing

RUN chown -R www-data:www-data /var/www/html/assets/img/uploads