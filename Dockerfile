# Use an official PHP image
FROM php:8.2-fpm

# Install Caddy
RUN apt-get update && apt-get install -y curl && \
    curl -1sLf 'https://dl.cloudsmith.io/public/caddy/stable/gpg.key' | gpg --dearmor -o /usr/share/keyrings/caddy-stable-archive-keyring.gpg && \
    curl -1sLf 'https://dl.cloudsmith.io/public/caddy/stable/debian.deb.txt' | tee /etc/apt/sources.list.d/caddy-stable.list && \
    apt-get update && apt-get install caddy -y

# Copy application code
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Copy a basic Caddyfile
COPY Caddyfile /etc/caddy/Caddyfile

# Start Caddy and PHP-FPM together
CMD ["sh", "-c", "php-fpm & caddy run --config /etc/caddy/Caddyfile --adapter caddyfile"]
