FROM php:8.1-fpm

RUN mkdir /app

RUN apt-get update && apt-get install -y \
        git \
        unzip \
    && docker-php-ext-install bcmath

RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --version=2.3.10 \
        --install-dir=/usr/local/bin && \
        echo "alias composer='composer'" >> /root/.bashrc && \
        composer

COPY conf.d/* $PHP_INI_DIR/conf.d/

WORKDIR /app

RUN usermod -u 1000 www-data
