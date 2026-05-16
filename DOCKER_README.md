# Docker Setup - Museum Perjuangan

Persiapan lengkap untuk menjalankan Museum Perjuangan di Docker.

## 🚀 Quick Start

### Windows
```bash
.\docker-setup.bat
```

### Linux / Mac
```bash
bash docker-setup.sh
```

### Manual Setup
```bash
cp .env.docker .env
docker-compose build
docker-compose up -d
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate:fresh --seed
```

Akses aplikasi di **http://localhost**

---

## 📚 Dokumentasi

### Untuk Pemula
1. **[SETUP.md](SETUP.md)** - Panduan lengkap setup (Local, Docker, Production)
2. **[DOCKER_GUIDE.md](DOCKER_GUIDE.md)** - Panduan Docker step-by-step

### Untuk Referensi Cepat
- **[DOCKER_COMMANDS.md](DOCKER_COMMANDS.md)** - Kumpulan perintah Docker yang sering digunakan
- **[DOCKER_FILES.md](DOCKER_FILES.md)** - Penjelasan setiap file konfigurasi Docker

### Setup Scripts
- **[docker-setup.bat](docker-setup.bat)** - Otomatis setup untuk Windows
- **[docker-setup.sh](docker-setup.sh)** - Otomatis setup untuk Linux/Mac

### Configuration Files
- **[docker-compose.yml](docker-compose.yml)** - Main configuration (app + db services)
- **[docker-compose.override.yml](docker-compose.override.yml)** - Development overrides
- **[.env.docker](.env.docker)** - Environment variables template untuk Docker
- **[.env.local](.env.local)** - Environment variables untuk local development
- **[Dockerfile](Dockerfile)** - PHP 7.4 Apache image definition
- **[.dockerignore](.dockerignore)** - Files excluded from Docker image

---

## ⚙️ Konfigurasi

### Environment Variables
Database default untuk Docker:
```env
DB_HOST=db              # PENTING: gunakan 'db' bukan localhost
DB_PORT=3306
DB_DATABASE=museumperjuangan
DB_USERNAME=laravel
DB_PASSWORD=laravel
```

Ubah port jika diperlukan:
```env
APP_PORT=80             # Apache web server
DB_PORT=3306            # MySQL server
```

### Services
- **app**: PHP 7.4 + Apache (port 80)
- **db**: MySQL 8.0 (port 3306)

---

## 📋 Perintah Umum

```bash
# Start
docker-compose up -d

# Stop
docker-compose stop

# Lihat status
docker-compose ps

# Lihat logs
docker-compose logs -f

# Run artisan command
docker-compose exec app php artisan migrate

# SSH ke container
docker-compose exec app bash

# Backup database
docker-compose exec db mysqldump -u laravel -p museumperjuangan > backup.sql

# Restore database
docker-compose exec db mysql -u laravel -p museumperjuangan < backup.sql
```

Lihat [DOCKER_COMMANDS.md](DOCKER_COMMANDS.md) untuk lebih banyak perintah.

---

## ✅ Troubleshooting

### Port sudah terpakai
Ubah di `.env`:
```env
APP_PORT=8080
DB_PORT=3307
```

### Database connection error
Pastikan:
1. `.env` menggunakan `DB_HOST=db` (bukan localhost)
2. Service db sudah running: `docker-compose ps`
3. Restart: `docker-compose restart`

### Permission denied
```bash
docker-compose exec app chmod -R 775 storage bootstrap/cache
```

### Container tidak bisa start
```bash
docker-compose logs app
docker-compose logs db
```

Lihat [SETUP.md](SETUP.md#troubleshooting) untuk troubleshooting lengkap.

---

## 📦 Prasyarat

- **Docker Desktop** - [Download](https://www.docker.com/products/docker-desktop)
- **RAM**: Minimal 2GB untuk Docker
- **Disk**: Minimal 5GB free space

---

## 🔗 Resources

- [Docker Documentation](https://docs.docker.com/)
- [Docker Compose Reference](https://docs.docker.com/compose/reference/)
- [Laravel Documentation](https://laravel.com/docs)
- [MySQL Documentation](https://dev.mysql.com/doc/)

---

## 💡 Tips

1. **Development**: Edit file lokal, perubahan langsung terlihat di container
2. **Database**: Persisten di volume `mysql_data`, tidak hilang saat restart
3. **Logs**: Gunakan `docker-compose logs -f` untuk debug
4. **Performance**: Untuk production, sesuaikan `docker-compose.yml` dan disable debug mode

---

## 📞 Support

Jika ada masalah:
1. Baca [DOCKER_GUIDE.md](DOCKER_GUIDE.md) untuk panduan lengkap
2. Cek logs: `docker-compose logs -f`
3. Lihat troubleshooting di [SETUP.md](SETUP.md#troubleshooting)

---

**Selamat! Docker setup sudah siap. Mulai dengan:**
```bash
cp .env.docker .env
docker-compose up -d
```

Akses aplikasi di: **http://localhost**
