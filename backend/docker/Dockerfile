FROM php:8.2.7-apache

RUN apt-get update

RUN apt-get install -y \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# #intall symfony cli
# RUN wget https://get.symfony.com/cli/installer -O - | bash
# RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

RUN a2enmod rewrite

COPY . /var/www/project

WORKDIR /var/www/project

EXPOSE 80

COPY /apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# Comando para inicializar o servidor Apache
CMD ["apache2-foreground"]
