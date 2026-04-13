# Etapa 1: Construcción de assets (Vite)
FROM node:20-alpine AS build-stage
WORKDIR /app
COPY . .
# Asegurarnos de que Vite compile para producción
RUN npm install && npm run build

# Etapa 2: Entorno de PHP 8.4 con Apache
FROM php:8.4-apache

# Instalar dependencias del sistema y extensiones de PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libsqlite3-dev \
    libpq-dev \
    && docker-php-ext-install pdo_mysql pdo_sqlite pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

# Habilitar mod_rewrite de Apache para Laravel
RUN a2enmod rewrite

# Configurar el DocumentRoot de Apache a /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configurar Apache para escuchar en el puerto que asigne Render ($PORT)
RUN sed -i 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf && \
    sed -i 's/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/g' /etc/apache2/sites-available/000-default.conf

# Copiar el código del proyecto
WORKDIR /var/www/html
COPY . .

# Copiar los assets compilados desde la primera etapa (Asegurando la ruta)
COPY --from=build-stage /app/public/build ./public/build

# Instalar Composer y dependencias de PHP
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Configurar permisos finales para TODO el proyecto (Esto arregla los assets)
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html/storage

# Comando para ejecutar migraciones, crear link de storage y arrancar Apache
CMD php artisan migrate --force && php artisan storage:link && apache2-foreground
