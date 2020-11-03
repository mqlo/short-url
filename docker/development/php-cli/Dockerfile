FROM php:7.4-cli-alpine

RUN docker-php-ext-install opcache \
    && apk add --no-cache bash coreutils \
# xdebug
    && apk add --no-cache autoconf g++ make \
    && pecl install xdebug \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug \
## mysql
#    && apk add libmcrypt-dev mysql-client \
#    && docker-php-ext-install pdo pdo_mysql
# posrgresql
    && apk add --no-cache postgresql-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql
# php redis
#    && apk add --no-cache pcre-dev $PHPIZE_DEPS \
#    && pecl install redis \
#    && docker-php-ext-enable redis.so

# composer
RUN apk add --no-cache unzip
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_MEMORY_LIMIT -1
RUN curl --noproxy -sS https://getcomposer.org/installer | php -- --version=1.10.17 --install-dir=/bin --filename=composer --quiet \
    && composer global require hirak/prestissimo --no-plugins --no-scripts \
    && rm -rf /root/.composer/cache

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini
COPY ./development/php/conf.d /usr/local/etc/php/conf.d
COPY ./development/wait-for-it.sh /usr/local/bin/wait-for-it
RUN chmod 555 /usr/local/bin/wait-for-it

WORKDIR /app
