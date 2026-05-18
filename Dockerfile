# Gunakan versi yang lebih spesifik dan stabil
FROM php:7.3-fpm-alpine

# Install minimal dependencies saja
RUN apk add --no-cache \
    nginx \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    oniguruma-dev

# Install extension PHP yang paling penting saja
RUN docker-php-ext-install pdo pdo_mysql mbstring zip gd

# Copy composer dari official image (lebih cepat daripada download)
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy file project
COPY . .

# Konfigurasi Nginx
COPY ./nginx.conf /etc/nginx/http.d/default.conf

# Jalankan composer install dengan mode super hemat resource
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs --no-interaction --no-progress

# Set permission
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

COPY ./entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 5555

ENTRYPOINT ["entrypoint.sh"]
