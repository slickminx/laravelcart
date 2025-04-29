# Base image
FROM webdevops/php-nginx:8.2

# Set working directory
WORKDIR /app

# Copy only necessary files for build
COPY composer.json composer.lock ./

# Install Composer dependencies early (better Docker caching)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --prefer-dist --no-dev --no-scripts --optimize-autoloader

# Now copy the full app
COPY . .

# Copy the nginx config
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Copy example .env (Laravel expects it)
COPY .env.example .env

# Expose HTTP port
EXPOSE 8080

# Start supervisord (manages nginx + php-fpm)
CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]

RUN php artisan config:cache && php artisan route:cache
