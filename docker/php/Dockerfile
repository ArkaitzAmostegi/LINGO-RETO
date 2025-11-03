# Usa una imagen base de PHP con Apache
FROM php:8.3-apache

# 1. Instalar dependencias del sistema y extensiones de PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    # Limpia para reducir el tamaño de la imagen
    && rm -rf /var/lib/apt/lists/* \
    # Habilita las extensiones necesarias para Laravel
    && docker-php-ext-install pdo pdo_mysql zip exif pcntl gd

# 2. Instalar Composer globalmente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Configuración de Apache: Modificar el Virtual Host por defecto
# Copia la configuración de Apache que apunta al directorio 'public' de Laravel
# El archivo 000-default.conf existe por defecto en la imagen de Apache
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf

# 4. Habilitar el módulo 'rewrite' (necesario para URLs limpias de Laravel)
RUN a2enmod rewrite

# 5. Establecer el directorio de trabajo
WORKDIR /var/www/html

# El puerto 80 ya está expuesto por defecto por la imagen 'php:*-apache'