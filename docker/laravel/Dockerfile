FROM php:8.0.0-fpm-alpine

RUN apk add bash \
    php7-zip \
    php7-posix \
    php7-bcmath \
    php7-xmlrpc \
    php7-imap \
    php7-fpm \
    php7-cli \
    php7-opcache \
    php7-pdo \
    composer \
    php7-pdo_pgsql \
    php7-dom \
    php7-pcntl \
    php7-session \
    php7-xmlwriter \
    php7-redis \
    php7-tokenizer \
    php7-fileinfo


WORKDIR /opt

COPY ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 9000

ENTRYPOINT /entrypoint.sh
