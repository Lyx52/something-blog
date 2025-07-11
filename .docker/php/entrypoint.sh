#!/bin/sh
set -e

# Install dependencies && setup key if required
composer install --no-dev --optimize-autoloader

# Run migrations
php artisan migrate --force
php artisan db:seed --class=CategorySeeder --force

# Set permissions for Laravel directories
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

mkdir -p /sessions
chmod 777 /sessions

exec "$@"
