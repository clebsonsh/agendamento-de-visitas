FROM php:8.1-fpm-alpine

WORKDIR /app

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apk update && apk add --no-cache \
    pcre-dev ${PHPIZE_DEPS} \
    && MAKEFLAGS="-j $(nproc)" pecl install pcov \
    && docker-php-ext-enable pcov \
    && apk del pcre-dev ${PHPIZE_DEPS}

RUN docker-php-ext-install pdo_mysql opcache

COPY . /app

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

EXPOSE 9000
