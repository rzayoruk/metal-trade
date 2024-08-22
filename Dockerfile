FROM php:8.1-fpm

# php.ini dosyasını kopyala ve gerekli uzantıları etkinleştir
# RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

# Gerekli paketleri kur
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pgsql pdo pdo_pgsql

# php.ini dosyasında gerekli uzantıları etkinleştir
# RUN sed -i 's/;extension=pdo_pgsql/extension=pdo_pgsql/' /usr/local/etc/php/php.ini
# RUN sed -i 's/;extension=pgsql/extension=pgsql/' /usr/local/etc/php/php.ini

# Çalışma dizinini belirle
WORKDIR /var/www/html/public

# PHP-FPM'i başlat
CMD ["php-fpm"]
