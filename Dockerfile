# Stage 1: Build Stage
FROM composer:2.7 AS build

# Set working directory
WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies
#RUN composer install --prefer-dist --no-dev --no-scripts --optimize-autoloader
RUN composer install --prefer-dist --no-dev --no-scripts --optimize-autoloader || cat /root/.composer/cache/logs/*

# Copy the rest of the application
COPY . .

# Stage 2: Production Stage
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set working directory
WORKDIR /var/www/html

# Copy built app from previous stage
COPY --from=build /app /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copy nginx configuration
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Expose port
EXPOSE 80

# Start services (Nginx and PHP-FPM)
CMD service nginx start && php-fpm
