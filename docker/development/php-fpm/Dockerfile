FROM php:7.4-fpm-alpine

RUN docker-php-ext-install opcache \
# xdebug
    && apk add --no-cache autoconf g++ make \
    && pecl install xdebug \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug \
# mysql
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

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini
COPY ./development/php/conf.d /usr/local/etc/php/conf.d
COPY ./development/php-fpm/conf.d /usr/local/etc/php/conf.d

WORKDIR /app

#не работает в Windows - ломается синтаксис в entrypoint.sh
COPY ./development/php-fpm/entrypoint.sh /usr/local/bin/docker-php-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-php-entrypoint.sh

RUN unset `env | grep proxy | cut -d= -f1`
