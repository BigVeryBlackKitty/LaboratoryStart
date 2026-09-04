#!/bin/bash
set -e

echo "🚀 Запуск Laravel..."

# Создаем все необходимые папки
echo "📁 Создаем папки..."
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/testing
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Устанавливаем правильные права
echo "🔧 Устанавливаем права..."
chown -R www-data:www-data storage bootstrap
chmod -R 775 storage bootstrap/cache
chmod -R 775 storage/logs
chmod -R 775 storage/framework

# Генерируем ключ (если .env существует)
if [ -f .env ]; then
    echo "🔑 Генерируем ключ приложения..."
    php artisan key:generate --force
fi

# Очищаем кеш
echo "🧹 Очищаем кеш..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Создаем storage link (если нужно)
php artisan storage:link --force || true

echo "✅ Готово! Запускаем сервер..."
php artisan serve --host=0.0.0.0 --port=80