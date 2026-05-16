# Docker Commands Quick Reference

Referensi cepat perintah Docker yang sering digunakan untuk Museum Perjuangan.

## Startup & Shutdown

```bash
# Start services (background)
docker-compose up -d

# Start services (foreground - lihat logs)
docker-compose up

# Stop services (container tetap ada)
docker-compose stop

# Stop services tertentu
docker-compose stop app
docker-compose stop db

# Restart services
docker-compose restart

# Remove all containers (volumes tetap ada)
docker-compose down

# Remove semua termasuk volumes (HATI-HATI!)
docker-compose down -v
```

## Building

```bash
# Build images
docker-compose build

# Build tanpa cache
docker-compose build --no-cache

# Build service tertentu
docker-compose build app
docker-compose build db

# Pull latest base images
docker-compose pull
docker-compose build --pull
```

## Logs & Status

```bash
# Lihat status containers
docker-compose ps

# Lihat logs semua services (real-time)
docker-compose logs -f

# Lihat logs service tertentu
docker-compose logs -f app
docker-compose logs -f db

# Lihat 50 baris terakhir
docker-compose logs --tail=50

# Lihat logs dari 10 menit terakhir
docker-compose logs --since 10m
```

## Executing Commands

```bash
# Execute command di container
docker-compose exec app bash

# Run artisan command
docker-compose exec app php artisan migrate
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan tinker

# Run composer command
docker-compose exec app composer install
docker-compose exec app composer require package-name
docker-compose exec app composer update

# Run npm/node command
docker-compose exec app npm install
docker-compose exec app npm run dev
docker-compose exec app npm run prod

# Access MySQL shell
docker-compose exec db mysql -u laravel -p

# (Jika password required, ketik: laravel)
```

## Database Operations

```bash
# Backup database
docker-compose exec db mysqldump -u laravel -p museumperjuangan > backup.sql

# Restore database
docker-compose exec db mysql -u laravel -p museumperjuangan < backup.sql

# Run migrations
docker-compose exec app php artisan migrate

# Fresh migrations with seeder
docker-compose exec app php artisan migrate:fresh --seed

# Seed database
docker-compose exec app php artisan db:seed

# Access MySQL directly
docker-compose exec db mysql -u laravel -p

# Run query from terminal
docker-compose exec db mysql -u laravel -p -e "SELECT VERSION();"
```

## File Operations

```bash
# Copy file dari container ke host
docker cp container-name:/path/to/file ./local-path

# Copy file dari host ke container
docker cp ./local-path container-name:/path/to/file

# List files di container
docker-compose exec app ls -la

# Cat file dari container
docker-compose exec app cat path/to/file
```

## Troubleshooting

```bash
# Cek Docker version
docker --version
docker-compose --version

# Inspect container
docker-compose exec app env
docker-compose exec app pwd

# Check network connectivity
docker-compose exec app ping db

# View detailed service info
docker-compose config

# Validate docker-compose.yml
docker-compose config --quiet && echo "Valid"

# See container resource usage
docker stats

# Rebuild everything from scratch
docker-compose down -v
docker-compose build --no-cache
docker-compose up -d
```

## Development Workflow

```bash
# Initial setup
docker-compose up -d
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate:fresh --seed

# Daily work
docker-compose up -d

# Work on code...

# Check logs if something wrong
docker-compose logs -f

# Run tests
docker-compose exec app php artisan test

# When done
docker-compose stop

# Fresh start next day
docker-compose start
```

## Optimization

```bash
# Cache Laravel config
docker-compose exec app php artisan config:cache

# Cache routes
docker-compose exec app php artisan route:cache

# Cache views
docker-compose exec app php artisan view:cache

# Optimize autoloader
docker-compose exec app composer dump-autoload --optimize

# Clear all caches
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
```

## Useful Aliases (Linux/Mac)

Add ke `.bashrc` atau `.zshrc`:

```bash
# Docker aliases
alias dc='docker-compose'
alias dcup='docker-compose up -d'
alias dcdown='docker-compose down'
alias dclogs='docker-compose logs -f'
alias dcexec='docker-compose exec app'
alias dctinker='docker-compose exec app php artisan tinker'
alias dcmigrate='docker-compose exec app php artisan migrate'
alias dcseed='docker-compose exec app php artisan db:seed'

# Usage:
# dc ps              # lihat status
# dcup               # start
# dcdown             # stop
# dclogs             # lihat logs
# dcexec bash        # masuk container
# dctinker           # tinker
```

Source ulang terminal:

```bash
source ~/.bashrc
# atau
source ~/.zshrc
```

## Common Issues & Solutions

### Container takes too long to start

```bash
docker-compose logs db
# Wait for database to be ready before app starts
```

### "Cannot connect to database"

```bash
# Pastikan DB_HOST=db di .env
# Pastikan db service running
docker-compose ps

# Restart both services
docker-compose restart
```

### "Permission denied" on files

```bash
docker-compose exec app chown -R www-data:www-data .
docker-compose exec app chmod -R 775 storage bootstrap/cache
```

### "Port already in use"

```bash
# Ubah port di .env
APP_PORT=8080

# Atau cari process yang pakai port
lsof -i :80        # Linux/Mac
netstat -ano | findstr :80  # Windows
```

### Storage link not working

```bash
docker-compose exec app php artisan storage:link
```

---

## Resources

- [Docker Compose CLI Reference](https://docs.docker.com/compose/reference/)
- [Docker Exec Documentation](https://docs.docker.com/engine/reference/commandline/exec/)
- [Laravel Artisan Console](https://laravel.com/docs/artisan)

---

**Quick Tip**: Sebagian besar file di `.env` bisa diubah tanpa restart container, tapi beberapa setting (DATABASE, REDIS, MAIL) memerlukan restart.

```bash
# Restart jika mengubah konfigurasi penting
docker-compose restart app
```
