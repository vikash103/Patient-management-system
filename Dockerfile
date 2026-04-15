FROM php:8.2-cli

# System dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip \
    && docker-php-ext-install zip pdo pdo_mysql

# Composer install
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Project files copy
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel setup
RUN php artisan config:clear
RUN php artisan cache:clear

# Port expose
EXPOSE 10000

# ✅ IMPORTANT FIX (serve public folder)
CMD php -S 0.0.0.0:10000 -t public