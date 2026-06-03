FROM php:8.3-cli

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

RUN composer install --no-interaction --no-dev --optimize-autoloader

RUN if [ ! -f .env ]; then cp .env.example .env || touch .env; fi

RUN printf '%s\n' \
'#!/bin/sh' \
'set -e' \
'' \
'if [ ! -f .env ]; then' \
'  cp .env.example .env 2>/dev/null || touch .env' \
'fi' \
'' \
'if ! grep -q "^APP_KEY=base64:" .env 2>/dev/null; then' \
'  php artisan key:generate --force' \
'fi' \
'' \
'CACHE_STORE="${CACHE_STORE:-file}" php artisan config:clear || true' \
'CACHE_STORE="${CACHE_STORE:-file}" php artisan cache:clear || true' \
'php artisan view:clear || true' \
'' \
'exec php -S 0.0.0.0:${PORT:-10000} -t public' \
> /start.sh

RUN chmod +x /start.sh

EXPOSE 10000

CMD ["/start.sh"]
