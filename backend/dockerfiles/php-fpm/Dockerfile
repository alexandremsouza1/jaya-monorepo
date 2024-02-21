FROM php:8.2.8-fpm

# Update and install dependencies
RUN apt-get update && apt-get install -y \
	libssl-dev \
    libcurl4-openssl-dev \
    pkg-config \
    wget \
    git \
    zip \
    unzip \
&& rm -rf /var/lib/apt/lists/*

# Install and enable Xdebug
RUN pecl install xdebug \
&& docker-php-ext-enable xdebug

# Install and enable Redis extension
RUN pecl install redis \
&& docker-php-ext-enable redis

# Install and enable pcntl extension
RUN docker-php-ext-install pcntl

# Install and enable PDO MySQL extension
RUN docker-php-ext-install pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar arquivo de configuração
COPY php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www
