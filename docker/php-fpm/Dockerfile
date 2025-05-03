# docker/php-fpm/Dockerfile

FROM php:8.1-fpm

WORKDIR /var/www

# Config
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="0" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="10000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="192" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10"

# Initialize
RUN apt-get update && apt-get install -y unzip libpng-dev libjpeg-dev git libfreetype-dev libwebp-dev

# PHP Extension Install
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install opcache pdo_mysql gd

RUN pecl install xdebug && docker-php-ext-enable xdebug 

# Install composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Clean APK Cache
RUN rm -rf /var/cache/apk/*

# Entrypoint
CMD ["php-fpm"]

EXPOSE 9000
