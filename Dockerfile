FROM php:8.2-cli

# Install dependencies + PostgreSQL support
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libpq-dev \
    && docker-php-ext-install zip pdo pdo_pgsql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

# Permissions
RUN chmod -R 777 storage bootstrap/cache

EXPOSE 10000

CMD php artisan config:clear && \
    php artisan cache:clear && \
    php artisan migrate --force && \
    php -S 0.0.0.0:10000 -t public