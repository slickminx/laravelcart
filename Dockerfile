FROM php:8.2-fpm

# Install nginx
RUN apt-get update && apt-get install -y nginx

# Copy your app files
COPY . /var/www/html

# Copy Nginx config
COPY nginx.conf /etc/nginx/nginx.conf

# Expose the Heroku port
EXPOSE $PORT

# Start both nginx and php-fpm together
CMD service nginx start && php-fpm
