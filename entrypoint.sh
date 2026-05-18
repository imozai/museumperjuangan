#!/bin/sh

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
