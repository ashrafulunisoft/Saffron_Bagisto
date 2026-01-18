#!/bin/bash
set -e

echo "Starting entrypoint script..."

# Create cache directories if they don't exist
echo "Creating cache directories..."
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set proper permissions on cache directories only
echo "Setting permissions on cache directories..."
chown -R www-data:www-data storage 2>/dev/null || true
chown -R www-data:www-data bootstrap/cache 2>/dev/null || true
chmod -R 777 storage/framework 2>/dev/null || true
chmod -R 777 bootstrap/cache 2>/dev/null || true

# Generate application key if not set
if [ -f .env ]; then
    echo "Setting application key..."
    php artisan key:generate --ansi || true

    # Ensure VIEW_COMPILED_PATH is set in .env
    if ! grep -q "^VIEW_COMPILED_PATH=" .env; then
        echo "VIEW_COMPILED_PATH=bootstrap/cache" >> .env
        echo "Added VIEW_COMPILED_PATH to .env"
    fi
fi

# Clear any existing cache files to avoid conflicts
echo "Clearing old cache files..."
rm -rf storage/framework/cache/* || true
rm -rf bootstrap/cache/* || true

# Set environment variable for cache path
export APP_ENV="${APP_ENV:-local}"
export CACHE_DRIVER="${CACHE_DRIVER:-file}"
export VIEW_COMPILED_PATH="${VIEW_COMPILED_PATH:-bootstrap/cache}"

# Run post-install scripts to ensure everything is cached
echo "Caching configuration..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "Starting Apache..."
# Execute main command
exec "$@"
