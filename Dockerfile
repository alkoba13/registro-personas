# Use la imagen oficial de PHP 8 con FPM
FROM php:8-fpm

# Instala las extensiones de PHP necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip pdo_mysql

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establece el directorio de trabajo en el directorio de la aplicación de Laravel
WORKDIR /var/www/html

# Copia los archivos de la aplicación de Laravel al contenedor
COPY ./api .

# Instala las dependencias de Composer
RUN composer install

# Exponer el puerto 9000 para PHP-FPM
EXPOSE 9000

# Comando por defecto para iniciar PHP-FPM
CMD ["php-fpm"]