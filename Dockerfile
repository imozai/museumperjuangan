FROM php:8.2-apache

# 1. Konfigurasi Dasar
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public \
    COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html

# 2. Install Dependencies Sistem
RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip zip libcurl4-openssl-dev libfreetype6-dev libicu-dev \
    libjpeg62-turbo-dev libonig-dev libpng-dev libxml2-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" bcmath curl exif gd intl mbstring pdo_mysql xml zip \
    && a2enmod rewrite \
    && sed -ri "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf \
    && printf "<Directory %s>\n    AllowOverride All\n    Require all granted\n</Directory>\n" "${APACHE_DOCUMENT_ROOT}" > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel \
    && rm -rf /var/lib/apt/lists/*

# 3. Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4. Salin File Project (PENTING: Harus sebelum composer install)
COPY . .

# 5. Persiapan Folder dan Permission
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# 6. Install Dependencies Laravel
# Menggunakan --no-scripts untuk menghindari error jika folder database/seeds dicari terlalu awal
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction --no-progress --no-scripts

# 7. Finalisasi
EXPOSE 80

# Gunakan command default apache agar tidak butuh entrypoint.sh eksternal
CMD ["apache2-foreground"]
