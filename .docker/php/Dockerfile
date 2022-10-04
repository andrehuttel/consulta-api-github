FROM php:8.1.1-fpm

# Update packages and install composer and PHP dependencies.
RUN apt-get update && \
  DEBIAN_FRONTEND=noninteractive apt-get install -y \
    mariadb-client \
    libmemcached-dev \
    libpq-dev \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libbz2-dev \
    cron \
    nginx \
    && pecl channel-update pecl.php.net \
    && pecl install apcu

# PHP Extensions
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install zip 
RUN docker-php-ext-install bz2
RUN docker-php-ext-install pdo 
RUN docker-php-ext-install pdo_mysql 
RUN docker-php-ext-install pcntl
RUN docker-php-ext-configure gd \
&& docker-php-ext-install gd

# Install the PHP mcrypt extention (from PECL, mcrypt has been removed from PHP 7.2)
RUN pecl install mcrypt-1.0.5
RUN docker-php-ext-enable mcrypt

# Install the php memcached extension
RUN pecl install memcached && docker-php-ext-enable memcached

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#Nodejs
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -
RUN apt install nodejs -y

RUN groupadd -g 1000 teste-laravel-9
RUN useradd -u 1000 -ms /bin/bash teste-laravel-9 -g teste-laravel-9

ADD . /var/www/html
COPY --chown=teste-laravel-9:teste-laravel-9 . /var/www/html
WORKDIR /var/www/html

# Set permissions
RUN chmod 0775 ./bootstrap/cache -R
RUN chmod 0775 ./storage/* -R

USER 1000:1000

EXPOSE 9000
CMD ["php-fpm"]
