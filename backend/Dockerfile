FROM php:8.0.30-apache

WORKDIR /var/www/html
COPY . .

RUN apt-get update \
    && apt-get install -y libpq-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mysqli zip \
    && apt-get install -y default-mysql-client

RUN php -m   # List installed PHP modules

EXPOSE 80