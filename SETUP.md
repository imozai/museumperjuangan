# Panduan Instalasi Museum Perjuangan

Dokumentasi lengkap untuk setup dan menjalankan aplikasi Museum Perjuangan dalam berbagai lingkungan.

## Daftar Isi

1. [Persiapan Awal](#persiapan-awal)
2. [Setup Local Development](#setup-local-development)
3. [Setup dengan Docker](#setup-dengan-docker)
4. [Setup Production](#setup-production)
5. [Troubleshooting](#troubleshooting)

---

## Persiapan Awal

### Prasyarat Umum

- Git
- Terminal/Command Prompt
- Text Editor (VS Code, Sublime, dll)

### Cloning Repository

```bash
# Clone repository
git clone <repository-url> museumperjuangan
cd museumperjuangan
```

---

## Setup Local Development

Untuk development di mesin lokal tanpa Docker.

### Prasyarat

- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi (atau MariaDB)
- Composer
- Node.js & NPM (opsional, untuk asset compilation)

### Langkah-langkah

#### 1. Install Dependencies PHP

```bash
composer install
```

#### 2. Setup Environment Variables

```bash
# Copy file environment
cp .env.local .env

# Atau gunakan file example
cp .env.example .env
```

#### 3. Generate Application Key

```bash
php artisan key:generate
```

#### 4. Setup Database

```bash
# Jika MySQL sudah berjalan, jalankan migrasi
php artisan migrate

# (Opsional) Jalankan seeder untuk data dummy
php artisan migrate:fresh --seed
```

#### 5. Setup Storage

```bash
# Buat symbolic link untuk storage
php artisan storage:link
```

#### 6. Install Frontend Dependencies (Opsional)

```bash
npm install

# Compile assets
npm run dev

# Atau untuk production
npm run prod
```

### Menjalankan Aplikasi

#### Option 1: Built-in PHP Server

```bash
php artisan serve

# Aplikasi akan tersedia di http://localhost:8000
```

#### Option 2: Menggunakan Laragon/XAMPP/Local Server

1. Pastikan document root mengarah ke folder `public/`
2. Pastikan MySQL berjalan
3. Akses melalui browser sesuai konfigurasi

### Testing

```bash
# Jalankan unit tests
php artisan test

# Atau gunakan phpunit
./vendor/bin/phpunit
```

### Membersihkan Cache (jika ada masalah)

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## Setup dengan Docker

Untuk menjalankan aplikasi dalam Docker container.

### Prasyarat

- Docker Desktop (atau Docker + Docker Compose)
  - [Unduh Docker Desktop](https://www.docker.com/products/docker-desktop)
- Minimal 2GB RAM untuk Docker
- Minimal 5GB disk space

### Quick Start (Otomatis)

#### Untuk Windows:

```bash
# Double-click file
docker-setup.bat

# Atau jalankan dari PowerShell
.\docker-setup.bat
```

#### Untuk Linux/Mac:

```bash
# Jalankan script
bash docker-setup.sh

# Atau berikan permission terlebih dahulu
chmod +x docker-setup.sh
./docker-setup.sh
```

### Setup Manual

#### 1. Copy Environment File

```bash
cp .env.docker .env
```

#### 2. Build dan Start Services

```bash
# Build images
docker-compose build

# Start services dalam background
docker-compose up -d

# Atau lihat logs
docker-compose up
```

#### 3. Generate Application Key

```bash
docker-compose exec app php artisan key:generate
```

#### 4. Run Database Migrations

```bash
docker-compose exec app php artisan migrate

# Atau dengan seeder
docker-compose exec app php artisan migrate:fresh --seed
```

#### 5. (Opsional) Setup Frontend Assets

```bash
docker-compose exec app npm install
docker-compose exec app npm run dev
```

### Akses Aplikasi

- **Aplikasi**: http://localhost
- **Database**: localhost:3306
  - Username: `laravel`
  - Password: `laravel`
  - Database: `museumperjuangan`

### Perintah Umum Docker

```bash
# Lihat status containers
docker-compose ps

# Lihat logs
docker-compose logs -f

# Stop services
docker-compose stop

# Hapus containers (data DB tetap tersimpan di volume)
docker-compose down

# Hapus semua termasuk volumes (HATI-HATI!)
docker-compose down -v

# Rebuild images
docker-compose build --no-cache

# Restart services
docker-compose restart
```

### Perintah Artisan dalam Docker

```bash
# Format: docker-compose exec app php artisan <command>

docker-compose exec app php artisan migrate
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan tinker
```

### SSH ke Container

```bash
# Masuk ke PHP container
docker-compose exec app bash

# Masuk ke MySQL container
docker-compose exec db bash

# Jalankan command dan langsung keluar
docker-compose exec app ls -la
```

### Konfigurasi Port

Jika port default sudah terpakai, ubah di `.env`:

```env
APP_PORT=8080       # Apache/PHP
DB_PORT=3307        # MySQL
```

Atau ubah di `docker-compose.yml` langsung.

### Backup Database

```bash
# Backup
docker-compose exec db mysqldump -u laravel -p museumperjuangan > backup.sql

# Restore
docker-compose exec db mysql -u laravel -p museumperjuangan < backup.sql
```

### Untuk Informasi Lebih Lanjut

Lihat file [DOCKER_GUIDE.md](DOCKER_GUIDE.md) untuk dokumentasi lengkap.

---

## Setup Production

Untuk deployment ke production server.

### Prasyarat

- Server dengan PHP 7.4+
- MySQL 5.7+ server
- Composer installed
- SSH access ke server
- Domain/IP address

### Langkah-langkah

#### 1. Clone Repository

```bash
git clone <repository-url> /var/www/museumperjuangan
cd /var/www/museumperjuangan
```

#### 2. Setup Permission

```bash
# Jika menggunakan user tertentu
sudo chown -R www-data:www-data /var/www/museumperjuangan
sudo chmod -R 755 /var/www/museumperjuangan

# Storage dan cache harus writable
sudo chmod -R 775 storage bootstrap/cache
```

#### 3. Install Dependencies

```bash
composer install --optimize-autoloader --no-dev
```

#### 4. Setup Environment

```bash
# Copy environment file
cp .env.example .env

# Edit file dengan production credentials
nano .env
```

Konfigurasi penting untuk production:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database
DB_HOST=db-server.example.com
DB_DATABASE=museum_db
DB_USERNAME=db_user
DB_PASSWORD=strong_password

# Cache dan Session (gunakan Redis untuk scale)
CACHE_DRIVER=redis
SESSION_DRIVER=redis

# Queue (optional)
QUEUE_CONNECTION=database

# Mail
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
```

#### 5. Generate Key dan Cache

```bash
php artisan key:generate
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### 6. Setup Database

```bash
php artisan migrate --force
php artisan db:seed --force  # jika ingin seeding
```

#### 7. Setup Web Server

##### Untuk Nginx:

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/museumperjuangan/public;
    index index.php index.html index.htm;

    # Redirect HTTP ke HTTPS
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/museumperjuangan/public;
    index index.php index.html index.htm;

    # SSL Certificates
    ssl_certificate /etc/letsencrypt/live/yourdomain.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/yourdomain.com/privkey.pem;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
    }

    location ~ /\.ht {
        deny all;
    }

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
}
```

##### Untuk Apache:

Pastikan `.htaccess` di folder `public/` sudah benar dan mod_rewrite enabled.

#### 8. Setup SSL Certificate

```bash
# Menggunakan Let's Encrypt (recommended)
sudo certbot certonly --webroot -w /var/www/museumperjuangan/public -d yourdomain.com

# Auto-renewal (crontab)
0 0 1 * * /usr/bin/certbot renew --quiet
```

#### 9. Cronjob Setup

Untuk queue dan scheduled tasks:

```bash
# Edit crontab
crontab -e

# Tambahkan baris ini
* * * * * cd /var/www/museumperjuangan && php artisan schedule:run >> /dev/null 2>&1
```

#### 10. Setup Monitoring & Logging

```bash
# Jika menggunakan Supervisor untuk queue worker:
sudo nano /etc/supervisor/conf.d/museumperjuangan-worker.conf
```

```ini
[program:museumperjuangan-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/museumperjuangan/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
numprocs=4
user=www-data
```

Aktifkan:

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start museumperjuangan-worker:*
```

#### 11. Backup Strategy

```bash
# Buat backup database daily
0 2 * * * /usr/bin/mysqldump -u user -p password database | gzip > /backups/db-$(date +\%Y\%m\%d).sql.gz

# Buat backup aplikasi
0 3 * * * tar -czf /backups/app-$(date +\%Y\%m\%d).tar.gz /var/www/museumperjuangan
```

### Perintah Maintenance

```bash
# Check application health
php artisan health

# Clear cache
php artisan cache:clear

# Check queue
php artisan queue:failed

# Retry failed jobs
php artisan queue:retry all

# Maintenance mode
php artisan down

# Back online
php artisan up
```

---

## Troubleshooting

### Umum

#### Storage permission denied

```bash
# Linux/Mac
chmod -R 775 storage bootstrap/cache

# Atau dengan Docker
docker-compose exec app chmod -R 775 storage bootstrap/cache
```

#### Application key not set

```bash
php artisan key:generate
# atau dengan Docker
docker-compose exec app php artisan key:generate
```

#### Database connection failed

1. Pastikan MySQL/database server berjalan
2. Cek konfigurasi `.env` (host, user, password)
3. Pastikan database sudah dibuat
4. Untuk Docker: pastikan `DB_HOST=db` di `.env`

```bash
# Test connection
php artisan tinker
>>> DB::connection()->getPdo();
```

#### Views cache error

```bash
php artisan view:clear
php artisan view:cache
```

#### Composer error

```bash
# Clear composer cache
composer clear-cache

# Update composer
composer self-update

# Reinstall
rm composer.lock
composer install
```

### Docker Specific

#### Container tidak bisa konek database

1. Pastikan service `db` sudah running: `docker-compose ps`
2. Cek logs: `docker-compose logs db`
3. Pastikan di `.env` menggunakan `DB_HOST=db` (bukan localhost)

#### Permission denied di container

```bash
docker-compose exec app chown -R www-data:www-data .
docker-compose exec app chmod -R 775 storage bootstrap/cache
```

#### Port sudah terpakai

```bash
# Cari process yang menggunakan port
lsof -i :80    # untuk Linux/Mac
netstat -ano | findstr :80  # untuk Windows

# Atau ubah port di .env
APP_PORT=8080
```

#### Docker image build gagal

```bash
# Rebuild tanpa cache
docker-compose build --no-cache

# Cek logs
docker-compose logs

# Nuclear option (hati-hati!)
docker-compose down -v
docker system prune -a
docker-compose build
docker-compose up -d
```

### Performance Issues

```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimization
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Composer optimization
composer dump-autoload --optimize
```

### Log Files

```bash
# Local
tail -f storage/logs/laravel.log

# Docker
docker-compose logs -f app
docker-compose logs -f db
```

---

## Support & Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Docker Documentation](https://docs.docker.com/)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [Nginx Documentation](https://nginx.org/en/docs/)

## FAQ

**Q: Bagaimana cara backup database?**
```bash
# Local
mysqldump -u user -p database > backup.sql

# Docker
docker-compose exec db mysqldump -u laravel -p museumperjuangan > backup.sql
```

**Q: Bagaimana cara restore database?**
```bash
# Local
mysql -u user -p database < backup.sql

# Docker
docker-compose exec db mysql -u laravel -p museumperjuangan < backup.sql
```

**Q: Apakah bisa mengganti port Apache/MySQL?**

Ya, ubah di `.env` atau `docker-compose.yml` (untuk Docker).

**Q: Bagaimana cara deploy ke production?**

Lihat bagian [Setup Production](#setup-production).

---

**Last Updated**: May 16, 2026
