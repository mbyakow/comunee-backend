FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
        git \
        zip \
        libzip-dev \
        unzip \
    && docker-php-ext-install zip mysqli pdo_mysql

# composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& composer global require hirak/prestissimo --no-plugins --no-scripts

WORKDIR /var/www/public

EXPOSE 9000

CMD ["php-fpm"]
