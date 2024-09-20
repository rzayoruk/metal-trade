FROM php:8.1-fpm

# php.ini dosyasını kopyala ve gerekli uzantıları etkinleştir
# RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

# Gerekli paketleri kur
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pgsql pdo pdo_pgsql
# in order to create php.ini for phpcli :)
RUN ln -s /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini 


WORKDIR /var/www/html

# PHP-FPM'i başlat
CMD ["php-fpm"]
