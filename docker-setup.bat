@echo off
REM Docker Setup Script untuk Museum Perjuangan (Windows)
REM Script ini membantu setup awal Docker

setlocal enabledelayedexpansion

echo.
echo ==========================================
echo Museum Perjuangan - Docker Setup (Windows)
echo ==========================================
echo.

REM Check if Docker is installed
docker --version >nul 2>&1
if errorlevel 1 (
    echo [X] Docker tidak ditemukan. Silakan install Docker Desktop terlebih dahulu.
    echo Unduh dari: https://www.docker.com/products/docker-desktop
    pause
    exit /b 1
)

REM Check if Docker Compose is installed
docker-compose --version >nul 2>&1
if errorlevel 1 (
    echo [X] Docker Compose tidak ditemukan. Silakan install Docker Compose terlebih dahulu.
    pause
    exit /b 1
)

echo [OK] Docker dan Docker Compose ditemukan
echo.

REM Create .env from .env.docker if not exists
if not exist ".env" (
    echo [*] Membuat file .env dari template...
    copy .env.docker .env
    echo [OK] File .env berhasil dibuat
) else (
    echo [i] File .env sudah ada
)

echo.
echo [*] Building Docker images...
docker-compose build

echo.
echo [*] Starting Docker containers...
docker-compose up -d

echo.
echo [*] Menunggu services siap (30 detik)...
timeout /t 30 /nobreak

echo.
echo [*] Generating application key...
docker-compose exec -T app php artisan key:generate

echo.
echo [*] Installing dependencies...
docker-compose exec -T app composer install

echo.
echo [*] Konfigurasi Laravel...
docker-compose exec -T app php artisan storage:link 2>nul || echo [i] Storage link sudah ada

echo.
echo ==========================================
echo [OK] Setup Selesai!
echo ==========================================
echo.
echo Aplikasi tersedia di: http://localhost
echo.
echo Perintah yang berguna:
echo   - docker-compose logs -f        # Lihat logs
echo   - docker-compose stop           # Stop services
echo   - docker-compose down           # Hapus containers
echo   - docker-compose ps             # Lihat status containers
echo.
echo Untuk informasi lebih lanjut, lihat DOCKER_GUIDE.md
echo.
pause
