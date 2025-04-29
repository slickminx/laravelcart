# ---- Step 1: Base Image ----
    FROM webdevops/php-nginx:8.2

    # ---- Step 2: Set Working Directory ----
    WORKDIR /app
    
    # ---- Step 3: Copy Composer Files ----
    COPY composer.json composer.lock ./
    
    # ---- Step 4: Install Composer + PHP Dependencies ----
    RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
      && composer install --prefer-dist --no-dev --no-scripts --optimize-autoloader
    
    # ---- Step 5: Copy Full Application Code ----
    COPY . .
    
    # ---- Step 6: Copy nginx configuration ----
    COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
    
    # ---- Step 7: Prepare Laravel ----
    # Copy dummy .env so artisan commands won't fail
    COPY .env.example .env
    
    # Generate Laravel keys and cache config
    RUN php artisan config:clear \
      && php artisan config:cache \
      && php artisan route:cache \
      && php artisan view:cache
    
    # (optional but safer) Remove .env after build
    RUN rm -f .env
    
    # ---- Step 8: Expose Correct Port (8080 for Railway) ----
    EXPOSE 8080
    
    # ---- Step 9: Start Services ----
    CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]
    