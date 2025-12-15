FROM php:8.3-fpm

# Install ekstensi yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev libpq-dev zip unzip git curl \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --optimize-autoloader --no-interaction --no-scripts
EXPOSE 8080

# Use PHP's built-in web server to listen on port 8080 so Railway can route HTTP traffic.
# This is a minimal change to make the container serve HTTP; for production consider
# adding nginx or a process manager.
CMD ["sh", "-lc", "php -S 0.0.0.0:8080 -t public"]