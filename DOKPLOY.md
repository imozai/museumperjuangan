# Dokploy Deployment Guide - Museum Perjuangan

Panduan lengkap untuk deploy Museum Perjuangan menggunakan Dokploy.

## Apa itu Dokploy?

Dokploy adalah platform deployment self-hosted yang memudahkan deployment aplikasi Docker. Mirip dengan Vercel/Netlify tapi untuk full-stack applications.

**Resources:**
- Website: https://dokploy.com
- Documentation: https://dokploy.com/docs
- GitHub: https://github.com/Dokploy/dokploy

---

## Prasyarat

1. **Dokploy sudah terinstall** di server
   - Docker
   - Docker Compose
   - Dokploy application

2. **Akses ke Dokploy dashboard** dengan credentials

3. **Domain/IP server** sudah siap

4. **Repository sudah di Git** (GitHub, GitLab, Gitea, dll)

---

## Persiapan Repository

### 1. Pastikan File-file Penting Ada

✅ Sudah ada di project:
- `Dockerfile` - Multi-stage optimized untuk production
- `docker-compose.yml` - Local development
- `.dockerignore` - Files yang diexclude
- `.env.example` - Environment template

### 2. Create `.env.production` (Opsional untuk reference)

```env
APP_NAME="Museum Perjuangan"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-domain.com

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=museumperjuangan
DB_USERNAME=db_user
DB_PASSWORD=secure_password
DB_ROOT_PASSWORD=root_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

### 3. Push ke Repository

```bash
git add .
git commit -m "Prepare for Dokploy deployment"
git push origin main
```

---

## Setup di Dokploy Dashboard

### 1. Login ke Dokploy

Buka dashboard Dokploy di browser:
```
https://your-dokploy-server/
```

### 2. Buat Project Baru

1. Click **"Create Project"**
2. Isi informasi project:
   - **Project Name**: `museum-perjuangan`
   - **Description**: Museum Perjuangan Web Application

### 3. Setup Repository Connection

1. Di project, click **"Settings"** → **"Repository"**
2. Pilih platform Git:
   - GitHub
   - GitLab
   - Gitea
   - Custom Git

3. Connect repository:
   - Select/paste repository URL
   - Choose branch: `main` atau `master`
   - Setup automatic deploys (opsional)

### 4. Buat Service - Application (PHP)

1. Click **"Add Service"** → **"Application"**

2. **Basic Settings:**
   - **Service Name**: `app`
   - **Description**: Museum Perjuangan Laravel App
   - **Domain**: `yourdomain.com` atau `www.yourdomain.com`

3. **Dockerfile:**
   - **Dockerfile Path**: `./Dockerfile`
   - **Build Context**: `./`

4. **Ports:**
   - **Container Port**: `80`
   - **Published Port**: `80` atau `8000`

5. **Environment Variables:**

   Tambahkan di **"Environment Variables"**:

   ```
   APP_NAME=Museum Perjuangan
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=museumperjuangan
   DB_USERNAME=laravel
   DB_PASSWORD=YOUR_SECURE_PASSWORD
   LOG_CHANNEL=stack
   CACHE_DRIVER=file
   QUEUE_CONNECTION=sync
   SESSION_DRIVER=file
   SESSION_LIFETIME=120
   MAIL_DRIVER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your-email@gmail.com
   MAIL_PASSWORD=your-app-password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=noreply@yourdomain.com
   ```

   **⚠️ PENTING:**
   - Jangan commit `.env` ke git
   - Set values di Dokploy dashboard
   - Use strong passwords
   - APP_KEY diperlukan (generate dengan artisan key:generate lokal dulu)

6. **Deploy Key:**
   - Click **"Generate Deploy Key"** jika needed

7. **Advanced Settings:**
   - **Auto Deploy**: Enable (automatic deploy saat push ke branch)
   - **Restart Policy**: `unless-stopped`
   - **Memory Limit**: `512M` (atau sesuai kebutuhan)
   - **CPU Limit**: `0.5` (atau sesuai kebutuhan)

8. Click **"Deploy"** atau **"Save & Deploy"**

### 5. Buat Service - Database (MySQL)

1. Click **"Add Service"** → **"Database"** (atau **"Add Service"** → **"Application"** untuk MySQL)

2. **Jika menggunakan built-in Database Service:**
   - **Service Name**: `db`
   - **Database Type**: `MySQL`
   - **MySQL Version**: `8.0`
   - **Root Password**: Generate strong password
   - **Database Name**: `museumperjuangan`
   - **Database User**: `laravel`
   - **Database Password**: Generate strong password

3. **Jika menggunakan Database dari External Server:**
   - Set konfigurasi di environment variables aplikasi
   - DB_HOST: IP/domain database server

4. Click **"Deploy"**

### 6. Link Services

Di **Project Settings**, pastikan database terelinkkan:
1. Pergi ke **Services**
2. Pastikan `app` service bisa access `db` service
3. Network setting sudah otomatis di Dokploy

---

## Deploy Process

### First Deployment

```bash
# Di local, test Dockerfile dulu:
docker build -t museumperjuangan:test .

# Atau langsung deploy melalui Dokploy dashboard
# Click "Deploy" button di service app
```

**Dokploy akan:**
1. Clone repository
2. Build Docker image
3. Create dan run container
4. Setup networking
5. Configure reverse proxy (Nginx)
6. Generate SSL certificate (Let's Encrypt)

### Auto Deploy

Jika sudah enable **"Auto Deploy"**:
- Setiap push ke branch akan trigger deployment otomatis
- Monitor logs di Dokploy dashboard

### Manual Deployment

```bash
# Via Dashboard:
1. Pergi ke service app
2. Click "Deploy" button
3. Monitor logs
```

---

## Post-Deployment Setup

### 1. Generate Application Key

Setelah deployment pertama, pastikan app key sudah set:

**Option 1: Via Dokploy Console**
1. Di service app, click **"Console"**
2. Run command: `php artisan key:generate`

**Option 2: Via SSH**
```bash
docker exec museumperjuangan_app php artisan key:generate
```

**Option 3: Set di .env Environment Variables**
```
APP_KEY=base64:YOUR_KEY_HERE
```

### 2. Run Migrations

```bash
# Via Dokploy Console:
php artisan migrate --force

# Atau SSH:
docker exec museumperjuangan_app php artisan migrate --force
```

### 3. Setup Storage Link

```bash
# Via Dokploy Console:
php artisan storage:link

# Atau SSH:
docker exec museumperjuangan_app php artisan storage:link
```

### 4. Cache Configuration (Production)

```bash
# Via Dokploy Console:
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Monitoring & Logs

### View Logs

Di Dokploy dashboard:
1. Select service `app`
2. Click **"Logs"**
3. Real-time logs akan ditampilkan

```bash
# Via CLI (SSH ke server):
docker logs -f museumperjuangan_app
docker-compose logs -f app
```

### Health Check

Dockerfile sudah include health check:
```bash
# Check di Dokploy dashboard
# Service akan show "Healthy" jika OK
```

### Metrics

Monitor di Dokploy:
- CPU usage
- Memory usage
- Restart count
- Build history

---

## Update & Redeploy

### Automatic Update (dengan Auto Deploy)

```bash
# Local: buat commit dan push
git commit -am "Update feature"
git push origin main

# Dokploy akan auto deploy
# Monitor di dashboard
```

### Manual Update

```bash
# Local: buat changes dan push
git commit -am "Update"
git push origin main

# Di Dokploy dashboard:
# Click "Redeploy" atau "Deploy" button
```

### Rollback

Jika ada masalah:

1. **View Deployment History:**
   - Di service, click **"Deployments"**
   - Lihat list deployment history

2. **Rollback:**
   - Click deployment yang ingin diroll-back
   - Click **"Rollback"** button

---

## Database Management

### Backup Database

```bash
# Via SSH ke Dokploy server:
docker exec museumperjuangan_db mysqldump -u laravel -p museumperjuangan > /backups/db-$(date +%Y%m%d).sql

# Atau gunakan Dokploy Database service built-in backup feature
```

### Restore Database

```bash
# Via SSH:
docker exec -i museumperjuangan_db mysql -u laravel -p < backup.sql
```

### Access Database

```bash
# Via SSH ke Dokploy server:
docker exec -it museumperjuangan_db mysql -u laravel -p museumperjuangan

# Atau gunakan database client GUI
# Host: your-dokploy-server
# Port: 3306
# User: laravel
# Password: (dari env variables)
```

---

## SSL/HTTPS Setup

### Automatic (Recommended)

Dokploy otomatis setup Let's Encrypt:

1. Di service app settings, pastikan domain sudah benar
2. Dokploy akan auto generate SSL certificate
3. Monitor di **"Settings"** → **"SSL"**

### Manual

Jika perlu manual setup:
1. Di Dokploy project settings
2. Click **"SSL"**
3. Upload custom certificate atau manage Let's Encrypt

---

## Environment Variables Management

### Safe Practices

1. **JANGAN commit `.env` ke git:**
   ```bash
   # Already in .gitignore
   ```

2. **Set di Dokploy dashboard:**
   - Service settings → Environment Variables
   - Add sensitive values di sini, bukan di .env.example

3. **Critical Variables:**
   - APP_KEY
   - DB_PASSWORD
   - MAIL_PASSWORD
   - API_KEYS
   - Etc.

4. **Update variables:**
   - Change di Dokploy dashboard
   - Click "Save"
   - Service akan auto restart

---

## Troubleshooting

### Build Failed

```bash
# Check logs di dashboard
# Atau SSH ke server
docker build -t test . --no-cache

# Common issues:
# - Missing dependencies di Dockerfile
# - composer.lock outdated
# - Invalid Dockerfile syntax
```

### Container Crash/Won't Start

```bash
# Check logs
docker logs -f museumperjuangan_app

# Common issues:
# - APP_KEY not set
# - Database connection failed
# - Permission issues
```

### Database Connection Failed

```bash
# Check:
1. DB_HOST correct (should be 'db' dalam Docker)
2. DB_USERNAME dan DB_PASSWORD benar
3. Database service sudah running
4. Network link tersetup dengan benar
```

### Performance Issues

```bash
# Optimize:
php artisan config:cache
php artisan route:cache

# Monitor resources
# Di Dokploy dashboard → Metrics

# Increase if needed:
# Memory Limit
# CPU Limit
```

### High Memory Usage

```bash
# Clear caches
php artisan cache:clear
php artisan view:clear

# Check storage/logs - hapus old logs
# Increase memory limit di Dokploy settings
```

---

## Production Checklist

```
☐ APP_DEBUG = false
☐ APP_ENV = production
☐ APP_KEY set dan tidak empty
☐ Database backup strategy sudah ada
☐ SSL certificate active
☐ Monitoring/alerting setup
☐ Logs rotation configured
☐ Storage cleanup scheduled
☐ Email configuration tested
☐ Cron jobs configured (jika needed)
☐ Database optimized dan indexed
☐ Static assets optimized
☐ API rate limiting configured
☐ Admin user created
☐ Backup restore tested
```

---

## Useful Commands (SSH to Dokploy Server)

```bash
# List containers
docker ps -a

# View logs
docker logs -f museumperjuangan_app
docker-compose logs -f

# Execute command in container
docker exec -it museumperjuangan_app php artisan tinker
docker exec -it museumperjuangan_app bash

# Database backup
docker exec museumperjuangan_db mysqldump -u laravel -p museumperjuangan > backup.sql

# Restart service
docker restart museumperjuangan_app
docker-compose restart app

# View resource usage
docker stats

# Cleanup
docker system prune -a
```

---

## Linking with Git Repository

### GitHub Actions (Auto Deploy)

Create `.github/workflows/deploy.yml`:

```yaml
name: Deploy to Dokploy

on:
  push:
    branches:
      - main
      - master

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - name: Trigger Dokploy Deploy
        run: |
          curl -X POST \
            -H "Authorization: Bearer ${{ secrets.DOKPLOY_TOKEN }}" \
            https://your-dokploy-server/api/deploy \
            -d '{"serviceId": "YOUR_SERVICE_ID"}'
```

### Manual Webhook

Setup webhook di repository untuk trigger Dokploy deployment otomatis.

---

## Performance Optimization for Dokploy

### Dockerfile Optimization (Already Applied)

- ✅ Multi-stage build → smaller image size
- ✅ OPCache configured
- ✅ Production PHP settings
- ✅ Health checks
- ✅ Gzip compression enabled

### Laravel Optimization

```bash
# In production deployment
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Composer optimization
composer dump-autoload --optimize
```

### Database Optimization

- Create indexes on frequently queried columns
- Analyze query performance
- Regular maintenance (OPTIMIZE TABLE)

---

## Migration Path

### From Local to Dokploy

1. **Ensure project is Git-ready** ✅
2. **Dockerfile optimized** ✅
3. **Push to repository** 
4. **Connect repository di Dokploy**
5. **Configure services** (app + db)
6. **Deploy**
7. **Run migrations**
8. **Test in production**

### From Other Hosting

If migrating dari hosting lain:

1. **Backup database** dari old hosting
2. **Export files** jika ada custom modifications
3. **Deploy ke Dokploy** dengan setup baru
4. **Import database** ke MySQL service
5. **Test thoroughly**
6. **Update DNS** ke Dokploy server

---

## Support & Resources

- **Dokploy Documentation**: https://dokploy.com/docs
- **Dokploy Discord**: https://discord.gg/dokploy
- **Laravel Deployment**: https://laravel.com/docs/deployment
- **Docker Documentation**: https://docs.docker.com/

---

## Deployment Diagram

```
┌─────────────────────────────────────────────────────────────┐
│                   Your Development PC                        │
│  (Edit code, run: git commit && git push)                   │
└────────────────────────────┬────────────────────────────────┘
                             │
                             ▼
┌─────────────────────────────────────────────────────────────┐
│                   Git Repository                             │
│  (GitHub, GitLab, Gitea, etc.)                              │
└────────────────────────────┬────────────────────────────────┘
                             │
                      (Webhook trigger)
                             │
                             ▼
┌─────────────────────────────────────────────────────────────┐
│                   Dokploy Server                             │
│  ┌─────────────────────────────────────────────────────┐   │
│  │ 1. Clone repository                                 │   │
│  │ 2. Build Docker image (from Dockerfile)             │   │
│  │ 3. Create container                                 │   │
│  │ 4. Setup networking (app <-> db)                    │   │
│  │ 5. Configure reverse proxy (Nginx)                  │   │
│  │ 6. Setup SSL/HTTPS                                  │   │
│  │ 7. Health checks & monitoring                       │   │
│  └─────────────────────────────────────────────────────┘   │
│                                                              │
│  Services:                                                   │
│  ├─ app (PHP-Apache) → Port 80/443                         │
│  └─ db (MySQL 8.0) → Port 3306                            │
└─────────────────────────────────────────────────────────────┘
                             │
                             ▼
         ┌───────────────────────────────────────┐
         │  Users Access Application              │
         │  https://yourdomain.com                │
         └───────────────────────────────────────┘
```

---

**Last Updated**: May 16, 2026
**Dokploy Version**: 1.0+
**PHP Version**: 7.4
**MySQL Version**: 8.0
