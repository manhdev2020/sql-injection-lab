FROM php:8.2.4-apache
COPY . /var/www/html
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql
CMD ["apache2ctl", "-D", "FOREGROUND"]