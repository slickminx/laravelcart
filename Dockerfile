FROM webdevops/php-nginx:8.2

# Set working directory
WORKDIR /app

# Copy your app files
COPY . .

# Copy default Nginx config
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Copy the .env file (important for Laravel during build)
COPY .env.example .env

# Install Composer (if not already installed in the base image)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies
RUN composer install --prefer-dist --no-dev --no-scripts --optimize-autoloader

# Expose port 80 for Nginx
EXPOSE 80

# Start PHP-FPM and Nginx (default in webdevops image)
CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]
