FROM php:7.4-apache

# 1. Install dependencies
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

# 2. Gunakan Composer (Gunakan versi 2 tidak apa-apa, asal project mendukung)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
WORKDIR /var/www/html

# 3. Konfigurasi Composer
ENV COMPOSER_MEMORY_LIMIT=-1
ENV COMPOSER_PROCESS_TIMEOUT=600

# --- PERBAIKAN DI SINI ---
# 4. Salin SEMUA file terlebih dahulu agar folder database/seeds tersedia
COPY . .

# 5. Hapus cache dan jalankan install dengan --no-autoloader
# Trik --no-autoloader ini agar composer tidak scanning folder sebelum instalasi selesai
RUN composer clear-cache || true \
    && composer install --no-dev --no-interaction --no-scripts --ignore-platform-reqs --no-autoloader

# 6. Jalankan dump-autoload secara manual setelah semua file ter-copy
RUN composer dump-autoload --optimize \
    && php artisan package:discover --ansi

# 7. Set Permission
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Sesuaikan port Apache (default 80, jika ingin 5555 harus ubah config apache juga)
EXPOSE 80
