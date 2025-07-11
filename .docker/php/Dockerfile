FROM node:22-alpine AS builder
WORKDIR /app

COPY package*.json ./
RUN npm install
COPY . .

RUN npm run build

FROM php:8.3-fpm AS runtime

COPY --from=builder /app/public /var/www

COPY .docker/php/php.ini /usr/local/etc/php/
COPY .docker/php/docker.conf /usr/local/etc/php-fpm.d/docker.conf
COPY .docker/php/.bashrc /root/

# Copy the entrypoint script
COPY .docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# mix
RUN apt-get update \
  && apt-get install -y build-essential zlib1g-dev default-mysql-client curl gnupg procps vim git unzip libzip-dev libpq-dev \
  && docker-php-ext-install zip pdo_mysql pdo_pgsql pgsql

# intl
RUN apt-get install -y libicu-dev \
  && docker-php-ext-configure intl \
  && docker-php-ext-install intl

# gd
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
docker-php-ext-install gd

# redis
RUN pecl install redis && docker-php-ext-enable redis

# pcov
RUN pecl install pcov && docker-php-ext-enable pcov

# pcntl
RUN docker-php-ext-install pcntl

# Node.js, NPM, Yarn
RUN curl -sL https://deb.nodesource.com/setup_22.x | bash -
RUN apt-get install -y nodejs
RUN npm install npm@latest -g
RUN npm install yarn -g

# Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin
RUN composer config --global process-timeout 3600
RUN composer global require "laravel/installer"

EXPOSE 5173
WORKDIR /var/www

#entrypoint
ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
