# docker/php-fpm/Dockerfile

FROM php:7.4-fpm-alpine

WORKDIR /var/www

# Config
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="0" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="10000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="192" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10"

# Initialize
# RUN apk update && apk upgrade

# Install dependencies and git
# RUN apk add --no-cache freetype-dev libpng-dev libjpeg-turbo-dev git

# PHP Extension Install
# RUN docker-php-ext-configure gd --with-freetype --with-jpeg
# RUN docker-php-ext-install opcache pdo_mysql gd

# Install composer
# COPY --from=composer /usr/bin/composer /usr/bin/composer

# Configure Environment
# RUN chmod -R a+w /var/www/web/sites/default/files/

# Clean APK Cache
RUN rm -rf /var/cache/apk/*

# Entrypoint
CMD ["php-fpm"]

EXPOSE 9000
EXPOSE 3000
EXPOSE 3001
