FROM webdevops/php-nginx:8.2
WORKDIR /app

# Install PHP dependencies early for caching
COPY composer.json composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --prefer-dist --no-dev --no-scripts --optimize-autoloader

# Copy full app and nginx config
COPY . .
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY .env.example .env

# Cache Laravel configs
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache && rm .env

EXPOSE 8080
CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]
