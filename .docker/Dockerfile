FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    supervisor \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY ./ /var/www/html

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN chown -R www-data: /var/www/html
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

COPY .docker/apache/apache-config.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD ["sh", "-c", "apachectl -D FOREGROUND & supervisord -c /etc/supervisor/conf.d/supervisord.conf"]
