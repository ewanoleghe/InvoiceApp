# Use the official PHP Alpine image as a base
FROM php:8.2-apache-alpine

# Install dependencies
RUN apk --no-cache add libpng libpng-dev libjpeg-turbo-dev libwebp-dev zlib-dev libxpm-dev && \
    docker-php-ext-configure gd --with-jpeg --with-webp --with-xpm && \
    docker-php-ext-install gd pdo_mysql

# Set the working directory
WORKDIR /var/www/html

# Copy the application code into the container
COPY . .

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["httpd", "-D", "FOREGROUND"]
