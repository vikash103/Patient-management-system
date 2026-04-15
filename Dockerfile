FROM php:8.2-cli

# ✅ Required packages + SQLite support
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip sqlite3 \
    && docker-php-ext-install zip pdo pdo_mysql pdo_sqlite

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy project
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# ✅ SQLite file create
RUN mkdir -p database && touch database/database.sqlite

# ✅ Permissions
RUN chmod -R 777 storage bootstrap/cache database

EXPOSE 10000

# ✅ IMPORTANT: runtime pe migrate chalega
CMD php artisan config:clear && \
    php artisan cache:clear && \
    php artisan migrate --force && \
    php -S 0.0.0.0:10000 -t public