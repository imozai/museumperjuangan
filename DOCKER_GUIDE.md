# Panduan Docker untuk Museum Perjuangan

Proyek ini dapat dijalankan menggunakan Docker dan Docker Compose. Panduan ini menjelaskan cara mempersiapkan dan menjalankan aplikasi dalam container Docker.

## Prasyarat

- [Docker](https://www.docker.com/products/docker-desktop) (v20.10+)
- [Docker Compose](https://docs.docker.com/compose/install/) (v1.29+)
- Terminal/Command Prompt

## Struktur Docker

Proyek ini menggunakan dua service:

1. **app**: Aplikasi Laravel dengan PHP 7.4 dan Apache
2. **db**: Database MySQL 8.0

## Persiapan Awal

### 1. Clone Repository dan Setup

```bash
# Clone atau copy project ke folder lokal
cd museumperjuangan

# Copy environment file
cp .env.docker .env
```

### 2. Generate Application Key

Sebelum menjalankan aplikasi pertama kali, generate application key:

```bash
docker-compose run --rm app php artisan key:generate
```

### 3. (Opsional) Jalankan Database Seeding

Jika ingin menggunakan data dummy:

```bash
docker-compose run --rm app php artisan migrate:fresh --seed
```

## Menjalankan Aplikasi

### Build dan Start Services

```bash
# Build image dan start semua services
docker-compose up -d

# Atau untuk development (lihat logs):
docker-compose up
```

Aplikasi akan tersedia di: `http://localhost`

### Melihat Logs

```bash
# Semua services
docker-compose logs -f

# Service tertentu
docker-compose logs -f app
docker-compose logs -f db
```

### Menghentikan Services

```bash
# Stop semua services (data tetap tersimpan)
docker-compose stop

# Hapus containers (volumes tetap ada)
docker-compose down

# Hapus semua termasuk volumes (HATI-HATI!)
docker-compose down -v
```

## Perintah Umum

### Laravel Commands

```bash
# Artisan commands
docker-compose exec app php artisan migrate
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan tinker

# Composer commands
docker-compose exec app composer require package-name
docker-compose exec app composer update

# NPM/Node commands (jika ada)
docker-compose exec app npm install
docker-compose exec app npm run dev
```

### Database

```bash
# Akses MySQL shell
docker-compose exec db mysql -u laravel -p museumperjuangan

# Backup database
docker-compose exec db mysqldump -u laravel -p museumperjuangan > backup.sql

# Restore database
docker-compose exec db mysql -u laravel -p museumperjuangan < backup.sql
```

### SSH ke Container

```bash
# Masuk ke PHP container
docker-compose exec app bash

# Masuk ke MySQL container
docker-compose exec db bash
```

## Konfigurasi Environment

File `.env` untuk Docker sudah disediakan di `.env.docker`. Konfigurasi utama:

- **DB_HOST**: `db` (nama service di docker-compose.yml)
- **DB_DATABASE**: `museumperjuangan`
- **DB_USERNAME**: `laravel`
- **DB_PASSWORD**: `laravel`
- **APP_PORT**: `80` (dapat diubah di .env)
- **DB_PORT**: `3306` (dapat diubah di .env)

Untuk mengubah konfigurasi:

```bash
# Edit .env dan ganti nilai yang diperlukan
nano .env

# Restart services jika ada perubahan
docker-compose restart app
```

## Troubleshooting

### Application key belum set

```bash
docker-compose run --rm app php artisan key:generate
```

### Permission denied pada storage

```bash
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
docker-compose exec app chmod -R ug+rwX storage bootstrap/cache
```

### Database tidak terkoneksi

1. Pastikan service `db` sudah running:
   ```bash
   docker-compose ps
   ```

2. Cek logs:
   ```bash
   docker-compose logs db
   ```

3. Pastikan konfigurasi di `.env` sudah benar (DB_HOST harus `db`)

### Port sudah terpakai

Ubah port di `.env` atau `docker-compose.yml`:

```env
# .env
APP_PORT=8080
DB_PORT=3307
```

Atau ubah di `docker-compose.yml` langsung.

### Rebuild image setelah perubahan Dockerfile

```bash
docker-compose build --no-cache
docker-compose up -d
```

## Production Deployment

Untuk deployment ke production:

1. Update konfigurasi di `.env`:
   - `APP_ENV=production`
   - `APP_DEBUG=false`
   - `APP_URL=https://yourdomain.com`

2. Generate application key:
   ```bash
   docker-compose run --rm app php artisan key:generate
   ```

3. Cache configuration:
   ```bash
   docker-compose run --rm app php artisan config:cache
   docker-compose run --rm app php artisan route:cache
   ```

4. Optimasi autoloader:
   ```bash
   docker-compose exec app composer install --optimize-autoloader --no-dev
   ```

## File Penting

- `Dockerfile` - Definisi image untuk aplikasi
- `docker-compose.yml` - Konfigurasi services
- `.env.docker` - Environment variables default untuk Docker
- `.dockerignore` - Files yang tidak disertakan dalam image

## Referensi

- [Docker Documentation](https://docs.docker.com/)
- [Docker Compose Documentation](https://docs.docker.com/compose/)
- [Laravel Docker Setup](https://laravel.com/docs/8.x/deployment#docker)
