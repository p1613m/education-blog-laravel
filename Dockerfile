FROM php:8.2.1-fpm-alpine

WORKDIR /var/www

RUN apk --update add \
    nano \
    git \
    curl \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    supervisor \
    nginx \
    openssl

ARG PHP_EXTENSIONS="exif intl mysqli opcache pdo_mysql xsl bcmath zip"

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN install-php-extensions $PHP_EXTENSIONS
RUN rm -rf /tmp/* /var/cache/apk/*

COPY .docker/nginx/default.conf /etc/nginx/http.d/default.conf
COPY .docker/php /usr/local/etc/php
COPY .docker/supervisord.conf /etc/supervisord.conf
COPY .docker/workers /etc/supervisor/conf.d
COPY . .

RUN composer install --no-dev
RUN mkdir -p "/var/log/supervisor"
RUN chmod -R 777 storage
RUN php artisan key:generate
RUN php artisan storage:link

EXPOSE 80 443

ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]
