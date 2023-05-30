FROM composer as build

WORKDIR /app

COPY yconnect-news /app

RUN composer install --no-dev

FROM php:8.2.6-apache

COPY --from=build /app /var/www/html/

RUN docker-php-ext-install mysqli opcache pdo_mysql pdo

RUN chown -R www-data:www-data /var/www/html/

RUN rm -r /var/www/html/public/storage

RUN php artisan storage:link

COPY vhost.conf /etc/apache2/sites-available

RUN a2dissite 000-default

RUN a2ensite vhost.conf

RUN a2enmod rewrite

RUN apache2ctl restart

EXPOSE 80