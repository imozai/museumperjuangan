FROM php:7.4-apache

# 1. Tambahkan ca-certificates & curl agar koneksi aman
RUN apt-get update && apt-get install -y --no-install-recommends \
    ca-certificates \
    curl \
    git \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" bcmath exif gd mbstring opcache pcntl pdo_mysql zip \
    && a2enmod rewrite headers

# 2. Gunakan Composer versi 1 (Lebih aman untuk project Laravel 7 lama)
COPY --from=composer:1 /usr/bin/composer /usr/bin/composer

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
WORKDIR /var/www/html

# 3. Konfigurasi Composer agar tidak timeout dan pakai RAM maksimal
ENV COMPOSER_MEMORY_LIMIT=-1
ENV COMPOSER_PROCESS_TIMEOUT=600

COPY composer.json composer.lock ./

# 4. Hapus cache jika ada dan install
RUN composer clear-cache || true
# Ganti perintah RUN composer install sebelumnya dengan ini
RUN composer update --no-dev --no-interaction --no-scripts --ignore-platform-reqs

COPY . .

# Lanjutkan sisa perintah...
RUN composer dump-autoload --optimize \
    && php artisan package:discover --ansi \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rwX storage bootstrap/cache

# Tambahkan ini sebelum EXPOSE 80
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

EXPOSE 80
