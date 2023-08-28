FROM php:8.1-fpm-alpine

WORKDIR /var/www/html

RUN apk update && apk add --no-cache \
    freetype \
    libpng \
    libjpeg-turbo \
    freetype-dev \
    libpng-dev \
    libjpeg-turbo-dev
RUN docker-php-ext-configure gd \
    --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql gd exif

COPY . /var/www/html

COPY ./.env /var/www/html/.env

RUN docker-php-ext-enable exif

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
