FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    libpng-dev \
    nodejs \
    npm \
    nginx \
    curl
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

COPY --chown=www-data . .
# install composer
COPY --from=composer:2.7.6 /usr/bin/composer /usr/bin/composer

# RUN npm install \
#     && npm run build

RUN mkdir -p /var/www/html/storage/framework/{sessions,views,cache} \
    && chown -R www-data:www-data /var/www/html/storage

RUN composer install
RUN php artisan config:clear
# RUN npm install \
#     && npm run build
# RUN php artisan migrate
# RUN php artisan cache:clear

# Expose port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
