FROM php:8.0.2-fpm-alpine3.13

RUN apk --update --no-cache add git
RUN docker-php-ext-install pdo_mysql

RUN apk update
RUN apk upgrade
RUN apk add bash

#COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/app

# Installing Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installing symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

EXPOSE 9000