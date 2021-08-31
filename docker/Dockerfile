FROM php:fpm-alpine

# Set working directory
RUN mkdir -p /var/www/html

RUN chown -R www-data: /var/www/html

WORKDIR /var/www/html
RUN set -ex && apk update

# Install Extensions
RUN docker-php-ext-install pdo pdo_mysql