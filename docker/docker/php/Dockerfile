FROM php:7.4-fpm
COPY php.ini /usr/local/etc/php/

RUN apt-get update \
  && apt-get install -y libzip-dev mariadb-client \
  && docker-php-ext-install zip pdo_mysql

RUN curl -SL https://deb.nodesource.com/setup_17.x | bash
RUN apt-get install -y nodejs

#Composer install
COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

ENV COMPOSER_HOME /composer

ENV PATH $PATH:/composer/vendor/bin


WORKDIR /var/www/workspace
