# Use PHP-FPM image
FROM php:7.3-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and required libraries
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    supervisor \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libmagickwand-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    curl \
    intl \
    && pecl install imagick \
    && docker-php-ext-enable imagick

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Laravel source code
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Create supervisor log directory
RUN mkdir -p /var/log/supervisor

# Copy supervisor config and startup script
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./docker/start-container /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container

# Expose port
EXPOSE 9000

# Start supervisor
CMD ["/usr/local/bin/start-container"]
