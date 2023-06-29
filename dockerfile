# Use an official PHP runtime as the base image
FROM webdevops/php-apache-dev

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the composer.json and composer.lock files to the container
COPY composer.json composer.lock ./

# Install PHP extensions and dependencies
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        unzip \
        && \
    docker-php-ext-install zip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install project dependencies
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application code to the container
COPY . .

# Generate the autoloader
RUN composer dump-autoload --optimize

# Set the document root of the web server
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Expose port 80 to the host
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]
