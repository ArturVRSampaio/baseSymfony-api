FROM php:8.2-fpm-alpine3.18
RUN apk --update --no-cache add git
RUN docker-php-ext-install pdo_mysql

RUN apk update
RUN apk upgrade
RUN apk add bash
RUN apk add tzdata

ENV TZ="America/Sao_Paulo"

WORKDIR /var/www/app

# Installing Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
EXPOSE 9000