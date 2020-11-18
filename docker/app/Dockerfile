FROM composer:1 as pickle

RUN cd /tmp \
    && git clone https://github.com/hrs-o/pickle.git \
    && cd pickle \
    && git checkout update/dumper-stability \
    && composer install --no-dev --optimize-autoloader \
    && php -d phar.readonly=0 box.phar build

FROM php:8.0-rc-fpm-alpine

COPY --from=pickle /tmp/pickle/pickle.phar /usr/local/bin/pickle

RUN apk upgrade --update && \
    apk --no-cache add autoconf build-base git libxml2-dev libzip-dev oniguruma-dev openssh rsync wget

RUN docker-php-ext-install -j$(nproc) zip pdo_mysql mysqli
RUN docker-php-ext-install -j$(nproc) bcmath ctype fileinfo mbstring tokenizer xml
RUN docker-php-ext-install -j$(nproc) opcache

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer self-update

#RUN wget https://github.com/FriendsOfPHP/pickle/releases/latest/download/pickle.phar -O /usr/local/bin/pickle \
#    && chmod +x /usr/local/bin/pickle

RUN pickle install apcu \
    && docker-php-ext-enable apcu

RUN pickle install xdebug-beta \
    && docker-php-ext-enable xdebug

RUN pickle install redis  \
    && docker-php-ext-enable redis

#RUN composer global require hirak/prestissimo
RUN composer global require squizlabs/php_codesniffer
RUN composer global require friendsofphp/php-cs-fixer
RUN composer global require phpmd/phpmd
RUN chmod 777 /var/log/

ENV PATH "/root/.composer/vendor/bin:$PATH"
