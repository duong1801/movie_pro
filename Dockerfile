FROM php:8.2-fpm-alpine

WORKDIR /var/www/html
RUN apk update \
    && apk add --no-cache --update linux-headers ${PHPIZE_DEPS} \
    && apk add libzip-dev \
       freetype-dev \
       libjpeg-turbo-dev \
       libpng-dev \
    && docker-php-ext-install \
       exif \
       mysqli \
       pdo \
       pdo_mysql \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install opcache
RUN docker-php-ext-configure gd \
    --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql gd exif
RUN docker-php-ext-enable exif

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
