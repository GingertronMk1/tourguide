FROM php:8.1-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql sockets

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install
