# Multi-stage build untuk production (optimized untuk Dokploy)
# Stage 1: Builder - Install dependencies
FROM php:7.4-apache as builder

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
WORKDIR /var/www/html

# Install build dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
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

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public \
    COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html

<<<<<<< HEAD
# Install only runtime dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    libfreetype6 \
    libjpeg62-turbo \
    libpng16-16 \
    libzip4 \
    libonig5 \
    libxml2 \
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
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy from builder stage
COPY --from=builder /var/www/html/vendor ./vendor
COPY --from=builder /usr/bin/composer /usr/bin/composer
=======
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    zip \
    libcurl4-openssl-dev \
    libfreetype6-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libonig-dev \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
    bcmath \
    curl \
    exif \
    gd \
    intl \
    mbstring \
    pdo_mysql \
    xml \
    zip \
    && a2enmod rewrite \
    && sed -ri "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf \
    && printf "<Directory %s>\n    AllowOverride All\n    Require all granted\n</Directory>\n" "${APACHE_DOCUMENT_ROOT}" > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
>>>>>>> 22c163aaadd024fab8541c3adb520e0c185568da

# Copy application files
COPY . .

<<<<<<< HEAD
# Setup Laravel
RUN composer dump-autoload --optimize \
    && php artisan package:discover --ansi \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache \
    && chown -R www-data:www-data . \
    && chmod -R ug+rwX storage bootstrap/cache \
    && chmod -R g+w storage bootstrap/cache

# PHP Configuration for Production
RUN { \
    echo "opcache.enable=1"; \
    echo "opcache.enable_cli=1"; \
    echo "opcache.memory_consumption=128"; \
    echo "opcache.interned_strings_buffer=8"; \
    echo "opcache.max_accelerated_files=4000"; \
    echo "opcache.revalidate_freq=60"; \
    echo "opcache.fast_shutdown=1"; \
    echo "memory_limit=256M"; \
    echo "max_execution_time=30"; \
    echo "upload_max_filesize=20M"; \
    echo "post_max_size=20M"; \
    } > /usr/local/etc/php/conf.d/laravel.ini

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=40s --retries=3 \
    CMD curl -f http://localhost/ || exit 1
=======
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/public/assets \
    && chmod -R 775 /var/www/html/storage /var/www/html/public/assets
>>>>>>> 22c163aaadd024fab8541c3adb520e0c185568da

RUN rm -f .htaccess \
    && mkdir -p storage/app/public storage/framework/cache storage/framework/sessions storage/framework/testing storage/framework/views bootstrap/cache \
    && composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction --no-progress \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rwx storage bootstrap/cache

# Pastikan ini setelah COPY . .
RUN mkdir -p /var/www/html/storage \
             /var/www/html/bootstrap/cache \
                          /var/www/html/public/storage/files \
                                       /var/www/html/public/assets/image/users

                                       RUN chown -R www-data:www-data /var/www/html/storage \
                                           /var/www/html/bootstrap/cache \
                                               /var/www/html/public/storage \
                                                   /var/www/html/public/assets

                                                   RUN chmod -R 775 /var/www/html/storage \
                                                       /var/www/html/bootstrap/cache \
                                                           /var/www/html/public/storage \
                                                               /var/www/html/public/assets


EXPOSE 5555
CMD ["apache2-foreground"]
