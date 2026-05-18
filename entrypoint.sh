#!/bin/sh
# Masuk ke direktori aplikasi
cd /var/www/html

# Paksa izin folder agar Laravel bisa menulis log dan cache
chmod -R 777 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Jalankan PHP-FPM di background
php-fpm -D

# Tunggu DB ready (opsional tapi disarankan)
echo "Menjalankan optimasi Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan migrasi jika DB sudah siap
# php artisan migrate --force

# Jalankan Nginx di foreground
nginx -g "daemon off;"
