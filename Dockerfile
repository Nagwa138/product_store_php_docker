FROM php:7.0-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

RUN docker-php-ext-install pdo pdo_mysql

# Get latest Composer
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer
