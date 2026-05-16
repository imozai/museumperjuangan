# Docker Configuration Files

File-file konfigurasi Docker untuk proyek Museum Perjuangan.

## Daftar File

### `Dockerfile`
Konfigurasi image untuk aplikasi Laravel dengan PHP 7.4 dan Apache.

**Features:**
- PHP 7.4-Apache base image
- Extension: bcmath, exif, gd, mbstring, opcache, pcntl, pdo_mysql, zip
- Apache rewrite module enabled
- Composer 2.2 pre-installed
- Automatic storage and cache directory setup

### `docker-compose.yml`
Konfigurasi utama untuk development environment dengan dua services:
- **app**: PHP-Apache application container
- **db**: MySQL 8.0 database container

**Fitur:**
- Automatic volume management
- Health checks untuk kedua services
- Networking setup
- Environment variable configuration
- Port mapping

### `docker-compose.override.yml`
Override file untuk local development (optional).
- Diload otomatis saat `docker-compose up`
- Debug mode enabled
- Live volume mounting untuk code editing

### `.env.docker`
Environment variables template untuk Docker.
- Database host sudah disetel ke `db` (service name)
- Port configuration
- Default credentials untuk development

Untuk production, ubah nilai-nilainya:
```env
APP_ENV=production
APP_DEBUG=false
DB_PASSWORD=strong-secure-password
MAIL_DRIVER=actual-smtp-driver
```

### `.dockerignore`
File dan folder yang tidak disertakan saat building image.
- Mengurangi ukuran image
- Mempercepat build process
- Exclude git, tests, vendor, node_modules, dll

## Quick Start

### 1. Setup Environment
```bash
cp .env.docker .env
```

### 2. Build dan Start
```bash
docker-compose build
docker-compose up -d
```

### 3. Initialize Application
```bash
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate:fresh --seed
```

### 4. Access Application
- **Web**: http://localhost
- **Database**: localhost:3306

## Service Details

### App Service
- **Image**: Custom built from Dockerfile
- **Container Name**: `museumperjuangan_app`
- **Port**: 80 (configurable via APP_PORT in .env)
- **Working Directory**: `/var/www/html`
- **Depends on**: db service

### DB Service
- **Image**: mysql:8.0 (official)
- **Container Name**: `museumperjuangan_db`
- **Port**: 3306 (configurable via DB_PORT in .env)
- **Volume**: mysql_data (persistent)
- **Initialization**: Loads museumperjuangan.sql on first run

## Volumes

### Application Volumes
- `./`: Host project directory mounted to `/var/www/html`
- `./storage`: Application storage
- `./bootstrap/cache`: Laravel cache

### Database Volumes
- `mysql_data`: Named volume for MySQL data persistence

## Networks

Kedua services terhubung melalui network `museumperjuangan_network`.
Memungkinkan komunikasi antar services dengan nama service sebagai hostname.

## Environment Variables

### Penting untuk Docker

```bash
# Harus disetel
DB_HOST=db              # Nama service, BUKAN localhost
REDIS_HOST=redis        # Jika menggunakan Redis
QUEUE_CONNECTION=sync   # Atau database/redis

# Port
APP_PORT=80             # Apache port
DB_PORT=3306            # MySQL port

# Database
DB_DATABASE=museumperjuangan
DB_USERNAME=laravel
DB_PASSWORD=laravel
DB_ROOT_PASSWORD=root   # MySQL root password
```

## Customization

### Mengubah PHP Version
Edit `Dockerfile`, ubah base image:
```dockerfile
FROM php:7.4-apache   # Ubah versi di sini
```

Versi yang tersedia:
- `php:7.3-apache`
- `php:7.4-apache`
- `php:8.0-apache`
- `php:8.1-apache`
- dll

### Menambah PHP Extension
Edit `Dockerfile` di bagian `docker-php-ext-install`:

```dockerfile
docker-php-ext-install -j"$(nproc)" \
    bcmath \
    exif \
    gd \
    your-new-extension \  # Tambah di sini
    # ... existing extensions
```

### Mengubah MySQL Version
Edit `docker-compose.yml`, ubah db image:
```yaml
db:
  image: mysql:5.7  # Ganti versi di sini
```

Versi yang tersedia:
- `mysql:5.7`
- `mysql:8.0`
- dll

### Menambah Services (Redis, Memcached, dll)
Tambah di `docker-compose.yml`:

```yaml
redis:
  image: redis:7-alpine
  container_name: museumperjuangan_redis
  ports:
    - "6379:6379"
  networks:
    - museumperjuangan_network
```

Update di app service `depends_on`:
```yaml
app:
  depends_on:
    - db
    - redis
```

## Best Practices

1. **Jangan ubah Dockerfile di production** - rebuild image terlebih dahulu
2. **Simpan sensitive data di .env** - jangan commit ke git
3. **Gunakan named volumes** untuk data yang perlu persist
4. **Set health checks** untuk critical services
5. **Gunakan docker-compose.override.yml** untuk development-specific settings
6. **Regular backup database** sebelum operations berbahaya
7. **Monitor logs** untuk deteksi masalah: `docker-compose logs -f`

## Troubleshooting

### Image build failed
```bash
docker-compose build --no-cache
docker-compose logs app
```

### Cannot connect to database
```bash
# Pastikan DB_HOST=db di .env
# Cek status
docker-compose ps
docker-compose logs db
```

### Permission issues
```bash
docker-compose exec app chown -R www-data:www-data .
docker-compose exec app chmod -R 775 storage bootstrap/cache
```

### Port conflicts
```bash
# Cari process pakai port
lsof -i :80

# Ubah port di .env
APP_PORT=8080
```

## Production Deployment

Untuk production, pertimbangkan:

1. **Use specific image versions** (bukan `latest`)
2. **Multi-stage builds** untuk reduce image size
3. **Separate docker-compose** untuk production
4. **Secrets management** untuk sensitive data
5. **Container orchestration** (Kubernetes, Docker Swarm)
6. **Registry** untuk store images
7. **CI/CD pipeline** untuk automated deployment

## Resources

- [Docker Documentation](https://docs.docker.com/)
- [Docker Compose Documentation](https://docs.docker.com/compose/)
- [PHP Official Docker Image](https://hub.docker.com/_/php)
- [MySQL Official Docker Image](https://hub.docker.com/_/mysql)

---

Untuk setup lengkap, lihat [DOCKER_GUIDE.md](DOCKER_GUIDE.md) atau [SETUP.md](SETUP.md).
