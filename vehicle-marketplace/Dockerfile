FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    libpq-dev libzip-dev libsqlite3-dev nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql pdo_sqlite mbstring exif bcmath pcntl gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files and install dependencies first (for caching)
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --ignore-platform-req=ext-exif

# Copy all application files
COPY . .

# Install npm dependencies and build frontend
RUN npm install && npm run build

# Create storage directories and link
RUN mkdir -p storage/app/public storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Make entrypoint executable
RUN chmod +x docker-entrypoint.sh

EXPOSE 8000

# Use entrypoint script to auto-run migrations + seed
ENTRYPOINT ["./docker-entrypoint.sh"]
