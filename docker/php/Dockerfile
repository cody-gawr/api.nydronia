# Image
FROM php:8.0-fpm

# Starting from scratch
RUN apt-get clean
RUN apt-get -y autoremove
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Dependencies
RUN apt-get update

# Zip
RUN apt-get install -y libzip-dev zip && docker-php-ext-configure zip && docker-php-ext-install zip

# Git
RUN apt-get install -y git

# Curl
RUN apt-get install -y libcurl3-dev curl && docker-php-ext-install curl

# GD
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

# PostgreSQL
RUN apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

# BC Math
RUN docker-php-ext-install bcmath

# Human Language and Character Encoding Support
RUN apt-get install -y zlib1g-dev libicu-dev g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

RUN docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install \
    pcntl \
    tokenizer

# PHP Redis extension
RUN pecl install redis
RUN docker-php-ext-enable redis

# ALL extensions
RUN docker-php-ext-install tokenizer

# Custom php.ini config
COPY php.ini /usr/local/etc/php/php.ini

# Install Xdebug
# RUN pecl install xdebug
# RUN docker-php-ext-enable xdebug

# Composer installation
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY entrypoint.sh /usr/local/bin/entrypoint
RUN chmod u+x /usr/local/bin/entrypoint

# Clean up
RUN apt-get clean
RUN apt-get -y autoremove
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Set up default directory
WORKDIR /var/www/api

CMD /usr/local/bin/entrypoint
