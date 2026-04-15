FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip \
    && docker-php-ext-install zip pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

# ✅ SQLite setup add karo (IMPORTANT)
RUN mkdir -p database \
    && touch database/database.sqlite

# ✅ Permissions
RUN chmod -R 777 storage bootstrap/cache database

# ✅ Cache clear + migrate
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan migrate --force

EXPOSE 10000

CMD php -S 0.0.0.0:10000 -t public