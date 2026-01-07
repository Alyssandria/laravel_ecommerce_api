#!/bin/sh

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Start PHP-FPM and Nginx
php-fpm &
nginx -g 'daemon off;'
