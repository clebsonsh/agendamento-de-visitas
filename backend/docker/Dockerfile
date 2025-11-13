FROM php:8.3-fpm-alpine

WORKDIR /app

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install pdo_mysql opcache

COPY composer.json composer.json

COPY composer.lock composer.lock

RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

COPY . /app

EXPOSE 9000
