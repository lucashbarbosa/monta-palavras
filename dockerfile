FROM php:8.0-apache
COPY . /usr/src/myapp
WORKDIR /usr/src/myapp
RUN apt-get update
RUN apt-get install unzip
RUN apt-get install curl
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer install
CMD [ "composer", "install"]
CMD [ "php", "./index.php" ]