FROM php:8.2-fpm


ENV COMPOSER_ALLOW_SUPERUSER 1


# Install composer
RUN curl -sSL https://getcomposer.org/installer | php \
    && chmod +x composer.phar \
    && mv composer.phar /usr/local/bin/composer


RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo_mysql
RUN apt-get update && apt-get install -y git zip unzip libcurl4-openssl-dev pkg-config libssl-dev libgd-dev



COPY ./dockerfiles/xdebug.ini $PHP_INI_DIR/conf.d/
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 8000

CMD ["/entrypoint.sh"]