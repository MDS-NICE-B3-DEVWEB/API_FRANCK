#Dockerfile laravel

FROM php:8.1.10

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install \
    intl \
    pdo \
    pdo_mysql \
    pgsql \
    zip \
    && useradd -u 1000 -d /app Franck

COPY . /app

COPY .env /app/.env

WORKDIR /app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer 

# ENV COMPOSER_ALLOW_SUPERUSER=1

# RUN  composer dump autoload

RUN composer global require laravel/installer

EXPOSE 8000

CMD composer install && php artisan key:generate && php artisan migrate:fresh && php artisan seed && php artisan serve \
    --host=0.0.0.0 --port=8000