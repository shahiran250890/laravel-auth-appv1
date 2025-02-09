FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    libpng-dev \
    nodejs \
    npm \
    nginx \
    curl \
    sudo
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install opcache

WORKDIR /var/www/html

COPY --chown=root:www-data . /var/www/html
# install composer
COPY --from=composer:2.7.6 /usr/bin/composer /usr/bin/composer

# RUN npm install \
#     && npm run build

RUN mkdir -p /var/www/html/storage/framework/{sessions,views,cache} \
    && chown -R www-data:www-data /var/www/html/storage

# Grant www-data group write access
# RUN addgroup root www-data

# RUN composer install
# RUN php artisan config:clear
# RUN npm install \
#     && npm run build
# RUN php artisan migrate
# RUN php artisan cache:clear

# Expose port
EXPOSE 9000

# Switch to www-data for security
USER www-data

# Start PHP-FPM
CMD ["php-fpm"]
