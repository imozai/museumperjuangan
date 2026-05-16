FROM php:7.4-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public \
    COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html

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

COPY . .

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/public/assets \
    && chmod -R 775 /var/www/html/storage /var/www/html/public/assets

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
