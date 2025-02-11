# backend/Dockerfile

FROM php:8.0-apache

WORKDIR /var/www/html

# Install necessary extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql mbstring

# Enable Apache mod_rewrite for Laravel
RUN a2enmod rewrite

# Copy the application into the container
COPY . /var/www/html

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 (Apache)
EXPOSE 80

CMD ["apache2-foreground"]
ENV COMPOSER_MEMORY_LIMIT=-1
