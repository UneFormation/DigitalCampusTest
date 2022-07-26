FROM php:8-cli-alpine

ENV PHPUNIT_VERSION "9.5.21"

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer \
    && wget "https://phar.phpunit.de/phpunit-${PHPUNIT_VERSION}.phar" \
    && chmod +x "phpunit-${PHPUNIT_VERSION}.phar" \
    && mv "phpunit-${PHPUNIT_VERSION}.phar" /usr/local/bin/phpunit \
    && apk --update --no-cache add autoconf g++ make \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

WORKDIR /app