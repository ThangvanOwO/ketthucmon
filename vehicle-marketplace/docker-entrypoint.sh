#!/bin/bash
set -e

echo "🚀 Starting Vehicle Marketplace..."

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generating APP_KEY..."
    php artisan key:generate --force
fi

# Cache configs for production
echo "⚡ Caching configs..."
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# Run migrations
echo "🗃️ Running migrations..."
php artisan migrate --force

# Run seeders (only if SEED_ON_START is set)
if [ "$SEED_ON_START" = "true" ]; then
    echo "🌱 Seeding database..."
    php artisan db:seed --force
fi

# Storage link
echo "🔗 Linking storage..."
php artisan storage:link --force 2>/dev/null || true

echo "✅ Ready! Starting server..."
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
