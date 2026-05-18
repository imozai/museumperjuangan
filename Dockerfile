FROM php:7.3-fpm-alpine

# Install system dependencies
# Alpine versi lama menggunakan library yang sedikit berbeda
RUN apk add --no-cache \
    nginx \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    libzip-dev \
    unzip \
    git \
    curl \
    icu-dev \
    oniguruma-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Setup Nginx config
COPY ./nginx.conf /etc/nginx/http.d/default.conf

# Install dependencies 
# Tambahan --ignore-platform-reqs untuk menghindari masalah library sistem di PHP lama
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Script entrypoint
COPY ./entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 5555

ENTRYPOINT ["entrypoint.sh"]