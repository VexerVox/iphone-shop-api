FROM php:8.3-fpm

ARG USERNAME=app

RUN apt-get update

RUN apt-get install -y unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo_mysql

RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

RUN apt-get update \
    && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev

RUN docker-php-ext-install exif bcmath

RUN apt-get install -y libgmp-dev && docker-php-ext-install gmp

RUN apt-get install -y sudo

RUN docker-php-ext-install sockets pcntl

RUN docker-php-ext-install gd
RUN apt-get install -y libzip-dev zip -y && docker-php-ext-install zip

WORKDIR /var/www/html


RUN apt-get update && apt-get -y install cron

RUN apt-get install -y --no-install-recommends --no-install-suggests supervisor

COPY supervisor/supervisor.conf /etc/supervisord.conf

COPY script.sh /var/www/script.sh

RUN chmod 744 /var/www/script.sh

RUN apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd


RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-install opcache

CMD ["/var/www/script.sh"]
