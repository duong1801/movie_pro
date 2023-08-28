FROM php:8.2-fpm-alpine


WORKDIR /var/www/html
RUN yum update -y && \
    yum install -y freetype freetype-devel libpng libpng-devel libjpeg-turbo libjpeg-turbo-devel
RUN docker-php-ext-configure gd \
    --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql gd exif
RUN docker-php-ext-enable exif

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
