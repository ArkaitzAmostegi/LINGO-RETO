# Usa una imagen base de PHP con Apache
FROM php:8.3-apache

# 1. Instalar herramientas necesarias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    gnupg \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    && rm -rf /var/lib/apt/lists/*

# 2. Instalar Node.js y npm (versión estable LTS: 20)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# 3. Instalar extensiones PHP necesarias para Laravel
RUN docker-php-ext-install pdo pdo_mysql zip exif pcntl gd

# 4. Instalar Composer globalmente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Configurar Apache (para apuntar a /public de Laravel)
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf

# 6. Habilitar módulo rewrite (URLs limpias)
RUN a2enmod rewrite

# 7. Establecer directorio de trabajo
WORKDIR /var/www/html
