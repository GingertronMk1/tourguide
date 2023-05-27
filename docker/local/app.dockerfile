FROM php:8.1-fpm-alpine

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN docker-php-ext-install sockets pdo pdo_mysql

RUN apk --update --no-cache add \
    $PHPIZE_DEPS \
    linux-headers \
    bash \
    && \
    pecl install -f xdebug-3.2.1 && \
    docker-php-ext-enable xdebug

WORKDIR /var/www

COPY . .
