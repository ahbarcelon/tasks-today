FROM php:8.2-cli

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libicu-dev \
        libonig-dev \
    && docker-php-ext-install intl mbstring mysqli \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --optimize-autoloader

COPY . .

RUN mkdir -p \
        writable/cache \
        writable/logs \
        writable/session \
        writable/debugbar \
        writable/uploads \
    && chown -R www-data:www-data writable

USER www-data

CMD ["sh", "-c", "php spark serve --host=0.0.0.0 --port=${PORT:-8080}"]