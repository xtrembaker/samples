FROM php:8.1-fpm

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Replace shell with bash so we can source files
RUN rm /bin/sh && ln -s /bin/bash /bin/sh

RUN apt-get update && apt-get install -yqq --no-install-recommends \
    git \
    curl \
    libzip-dev \
    zip \
    libmcrypt-dev \
    libicu-dev \
    default-mysql-client \
    vim \
    && apt-get autoremove -y \
    && rm -rf /var/lib/apt/lists/*

RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-install \
    pdo_mysql \
    intl \
    pcntl \
    zip \
    && docker-php-ext-configure intl

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

WORKDIR /var/www/samples