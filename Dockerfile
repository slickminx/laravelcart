FROM webdevops/php-nginx:8.2

# Set working directory
WORKDIR /app

# Copy app files
COPY . .

# Copy default nginx config
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Dummy env so composer install won't crash
COPY .env.example .env

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install --prefer-dist --no-dev --no-scripts --optimize-autoloader

# Expose port 80
EXPOSE 80

# Start nginx and php-fpm automatically (already done by webdevops image)
