FROM php:8.4-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY . .

RUN mkdir -p \
    bootstrap/cache \
    storage/framework/views \
    storage/framework/cache \
    storage/framework/sessions \
    storage/logs \
    && chown -R www-data:www-data bootstrap/cache storage \
    && chmod -R 775 bootstrap/cache storage

RUN composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader

RUN printf '%s\n' \
'#!/bin/sh' \
'set -e' \
'php artisan config:clear || true' \
'php artisan cache:clear || true' \
'php artisan view:clear || true' \
'exec php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"' \
> /start.sh

RUN chmod +x /start.sh

EXPOSE 10000
CMD ["/start.sh"]