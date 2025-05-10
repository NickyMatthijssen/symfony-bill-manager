# Use the official PHP image with FPM
FROM php:8.4-fpm AS symfony
LABEL authors="nickymatthijssen"

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    bash \
    nodejs \
    npm \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl intl bcmath gd opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

RUN composer install --no-interaction --prefer-dist --optimize-autoloader
RUN npm ci && npm run build

COPY docker/nginx/default.conf /etc/nginx/sites-enabled/default

RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 755 /var/www/html/public

EXPOSE 80
CMD php-fpm & nginx -g "daemon off;"