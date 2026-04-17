FROM php:8.2-cli

# Install system dependencies + PostgreSQL
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libpq-dev nodejs npm \
    && docker-php-ext-install zip pdo pdo_pgsql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies & build assets
RUN npm install && npm run build

# Permissions
RUN chmod -R 777 storage bootstrap/cache

EXPOSE 10000

CMD php artisan config:clear && \
    php artisan cache:clear && \
    php artisan config:cache && \
    php -S 0.0.0.0:10000 -t public