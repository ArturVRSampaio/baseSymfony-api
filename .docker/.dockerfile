FROM php:fpm-alpine3.20

RUN apk --update --no-cache add git $PHPIZE_DEPS icu-dev

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
install-php-extensions intl pdo_mysql

RUN apk update
RUN apk upgrade
RUN apk add bash
RUN apk add tzdata

ENV TZ="America/Sao_Paulo"

WORKDIR /var/www/app

# Installing Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
EXPOSE 9000