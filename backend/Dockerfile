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

RUN CACHE_STORE=file php artisan config:clear \
    && CACHE_STORE=file php artisan cache:clear \
    && CACHE_STORE=file php artisan view:clear

EXPOSE 10000

CMD php -S 0.0.0.0:${PORT:-10000} -t public
