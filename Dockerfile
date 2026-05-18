<<<<<<< HEAD
FROM php:8.2-fpm-alpine
=======
# Stage 1: Builder - Install dependencies
FROM php:7.4-apache AS builder
>>>>>>> 3656b3068afe01ef9c94c1b84683460935dabedb

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    libpng-dev \
<<<<<<< HEAD
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    libzip-dev \
    unzip \
    git \
    curl \
    oniguruma-dev \
    icu-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd intl
=======
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        bcmath \
        exif \
        gd \
        mbstring \
        opcache \
        pcntl \
        pdo_mysql \
        zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy Composer
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --prefer-dist \
    --optimize-autoloader

# Stage 2: Production Runtime - Minimal image
FROM php:7.4-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
WORKDIR /var/www/html

# Install only runtime dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    libfreetype6 \
    libjpeg62-turbo \
    libpng16-16 \
    libzip4 \
    libonig5 \
    libxml2 \
    zlib1g \
    zlib1g-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        bcmath \
        exif \
        gd \
        mbstring \
        opcache \
        pcntl \
        pdo_mysql \
        zip \
    && a2enmod rewrite headers \
    && a2enmod deflate \
    && sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf \
    && sed -ri -e "s!/var/www/!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && sed -ri -e "s!AllowOverride None!AllowOverride All!g" /etc/apache2/apache2.conf \
    && apt-get purge -y --auto-remove zlib1g-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy from builder stage
COPY --from=builder /var/www/html/vendor ./vendor
COPY --from=builder /usr/bin/composer /usr/bin/composer
>>>>>>> 3656b3068afe01ef9c94c1b84683460935dabedb

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

<<<<<<< HEAD
# Setup Nginx config
COPY ./nginx.conf /etc/nginx/http.d/default.conf
=======
# Setup Laravel
RUN composer dump-autoload --optimize \
    && php artisan package:discover --ansi \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache \
    && chown -R www-data:www-data . \
    && chmod -R ug+rwX storage bootstrap/cache
>>>>>>> 3656b3068afe01ef9c94c1b84683460935dabedb

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

<<<<<<< HEAD
# Permissions
RUN chown -R mw:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Script entrypoint
COPY ./entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]
=======
# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=40s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

EXPOSE 80
CMD ["apache2-foreground"]
>>>>>>> 3656b3068afe01ef9c94c1b84683460935dabedb
