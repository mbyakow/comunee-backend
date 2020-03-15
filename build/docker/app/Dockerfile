FROM php:7.4-fpm

# custom configs
COPY configs /

RUN apt-get update && apt-get install -y \
        git \
        zip \
        libzip-dev \
        unzip \
        libpq-dev \
    && pecl install xdebug-2.9.2 \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install zip pdo pgsql pdo_pgsql \
    && docker-php-ext-enable xdebug

# composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& composer global require hirak/prestissimo --no-plugins --no-scripts

WORKDIR /var/www/public

EXPOSE 9000

CMD ["php-fpm"]
