FROM php:8.0.0-fpm

ARG USER_ID
ARG GROUP_ID

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
RUN apt update -y && apt upgrade -y
RUN apt install -y nano
# https://github.com/mlocati/docker-php-extension-installer
# Add new extensions here
RUN install-php-extensions gd intl mysqli opcache pdo_mysql xdebug zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN userdel -f www-data && if getent group www-data ; then groupdel www-data; fi
RUN groupadd -g "$GROUP_ID" www-data
RUN useradd -l -u "${USER_ID}" -g www-data www-data
RUN install -d -m 0755 -o www-data -g www-data /home/www-data
RUN chown --changes --silent --no-dereference --recursive --from=33:33 ${USER_ID}:${GROUP_ID} \
        /home/www-data \
        /var/www

USER www-data

WORKDIR /var/www