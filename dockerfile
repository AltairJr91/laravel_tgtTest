FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libonig-dev libpng-dev libxml2-dev zlib1g-dev \
    default-mysql-client

RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]