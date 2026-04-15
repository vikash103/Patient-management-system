FROM php:8.2-cli

# Install dependencies + SQLite support
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip sqlite3 \
    && docker-php-ext-install zip pdo pdo_sqlite

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy files
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Create SQLite DB
RUN mkdir -p database && touch database/database.sqlite

# Permissions
RUN chmod -R 777 storage bootstrap/cache database

EXPOSE 10000

CMD php artisan config:clear && \
    php artisan migrate --force && \
    php -S 0.0.0.0:10000 -t public