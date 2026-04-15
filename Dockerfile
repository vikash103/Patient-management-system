FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip sqlite3 \
    && docker-php-ext-install zip pdo pdo_mysql pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

# SQLite file create
RUN mkdir -p database && touch database/database.sqlite

# Permissions
RUN chmod -R 777 storage bootstrap/cache database

EXPOSE 10000

CMD php -S 0.0.0.0:10000 -t public