FROM php:8.0.0-fpm

ARG USER_ID
ARG GROUP_ID

RUN apt update -y && apt upgrade -y
RUN apt install -y nano git libzip-dev zip curl

# Add new extensions here
RUN pecl install xdebug-3.0.4 && docker-php-ext-enable xdebug
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www