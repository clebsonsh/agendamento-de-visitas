FROM php:8.3-fpm-alpine

WORKDIR /app

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apk update && apk add --no-cache \
    pcre-dev ${PHPIZE_DEPS} \
    && MAKEFLAGS="-j $(nproc)" pecl install pcov \
    && docker-php-ext-enable pcov \
    && apk del pcre-dev ${PHPIZE_DEPS}

RUN docker-php-ext-install pdo_mysql opcache

COPY composer.json composer.json

COPY composer.lock composer.lock

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

COPY . /app

EXPOSE 9000
