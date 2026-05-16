#!/bin/bash

# Docker Setup Script untuk Museum Perjuangan
# Script ini membantu setup awal Docker

set -e

echo "=========================================="
echo "Museum Perjuangan - Docker Setup"
echo "=========================================="
echo ""

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    echo "❌ Docker tidak ditemukan. Silakan install Docker terlebih dahulu."
    exit 1
fi

# Check if Docker Compose is installed
if ! command -v docker-compose &> /dev/null; then
    echo "❌ Docker Compose tidak ditemukan. Silakan install Docker Compose terlebih dahulu."
    exit 1
fi

echo "✅ Docker dan Docker Compose ditemukan"
echo ""

# Create .env from .env.docker if not exists
if [ ! -f .env ]; then
    echo "📋 Membuat file .env dari template..."
    cp .env.docker .env
    echo "✅ File .env berhasil dibuat"
else
    echo "ℹ️  File .env sudah ada"
fi

echo ""
echo "🏗️  Building Docker images..."
docker-compose build

echo ""
echo "🚀 Starting Docker containers..."
docker-compose up -d

echo ""
echo "⏳ Menunggu services siap..."
sleep 10

echo ""
echo "🔑 Generating application key..."
docker-compose exec -T app php artisan key:generate

echo ""
echo "📦 Installing dependencies (jika diperlukan)..."
docker-compose exec -T app composer install

echo ""
echo "✨ Konfigurasi laravel.."
docker-compose exec -T app php artisan storage:link 2>/dev/null || true

echo ""
echo "=========================================="
echo "✅ Setup Selesai!"
echo "=========================================="
echo ""
echo "Aplikasi tersedia di: http://localhost"
echo ""
echo "Perintah yang berguna:"
echo "  - docker-compose logs -f        # Lihat logs"
echo "  - docker-compose stop           # Stop services"
echo "  - docker-compose down           # Hapus containers"
echo "  - docker-compose exec app bash  # SSH ke container"
echo ""
echo "Untuk informasi lebih lanjut, lihat DOCKER_GUIDE.md"
echo ""
