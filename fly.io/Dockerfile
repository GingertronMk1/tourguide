# Default to PHP 8.2, but we attempt to match
# the PHP version from the user (wherever `flyctl launch` is run)
# Valid version values are PHP 7.4+
FROM php:8.1-fpm-alpine AS base

RUN docker-php-ext-install pdo pdo_mysql sockets

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# copy application code, skipping files based on .dockerignore
COPY . /var/www/html

RUN composer install --optimize-autoloader \
    && mkdir -p storage/logs \
    && php artisan optimize:clear \
    && chown -R www-data:www-data /var/www/html \
    && sed -i 's/protected \$proxies/protected \$proxies = "*"/g' app/Http/Middleware/TrustProxies.php \
    && echo "MAILTO=\"\"\n* * * * * www-data /usr/bin/php /var/www/html/artisan schedule:run" > /etc/crontabs/laravel \
    && cp .fly/entrypoint.sh /entrypoint \
    && chmod +x /entrypoint


# Multi-stage build: Build static assets
# This allows us to not include Node within the final container
FROM node:20-alpine3.16 AS node

WORKDIR /app
COPY . .
COPY --from=base /var/www/html/vendor /app/vendor

RUN npm install && npm run build

# From our base container created above, we
# create our final image, adding in static
# assets that we generated above
FROM base

# Packages like Laravel Nova may have added assets to the public directory
# or maybe some custom assets were added manually! Either way, we merge
# in the assets we generated above rather than overwrite them
COPY --from=node /app/public /var/www/html/public-npm
RUN apk add rsync && \
    rsync -ar /var/www/html/public-npm/ /var/www/html/public/ \
    && rm -rf /var/www/html/public-npm \
    && chown -R www-data:www-data /var/www/html/public

COPY ./fly.io/nginx /etc/nginx

EXPOSE 8080

ENTRYPOINT ["/entrypoint"]
