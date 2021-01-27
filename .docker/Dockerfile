FROM php:7.4-apache

WORKDIR /var/www/html

#Install git
#RUN apt-get update -y \
#    apt-get install -y git
RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN apt-get update && \
    apt-get install -y zlib1g-dev libpng-dev  libzip-dev zip libxml2-dev libonig-dev 

RUN docker-php-ext-install gd
RUN docker-php-ext-install zip

COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html

RUN a2enmod rewrite
#Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=. --filename=composer
RUN mv composer /usr/local/bin/
COPY ./ /var/www/html/
EXPOSE 80