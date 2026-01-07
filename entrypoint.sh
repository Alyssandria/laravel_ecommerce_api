#!/bin/sh

# Wait for the database to be ready
echo "Waiting for database..."
while ! php artisan db:connect 2>/dev/null; do
    sleep 2
done

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Start PHP-FPM and Nginx
php-fpm &
nginx -g 'daemon off;'
