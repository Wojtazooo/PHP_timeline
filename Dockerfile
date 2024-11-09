# Use the official PHP image with Apache as the base image
FROM php:8.0-apache

# Copy your application files to the appropriate directory
COPY ./src /var/www/html/src

# Update DocumentRoot to point to /var/www/html/src
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/src|' /etc/apache2/sites-available/000-default.conf

# Enable the rewrite module
RUN a2enmod rewrite

# Allow .htaccess files to override configurations
RUN echo '<Directory /var/www/html/src>\n\
    AllowOverride All\n\
    </Directory>' >> /etc/apache2/sites-available/000-default.conf

# Install the mysqli extension
RUN docker-php-ext-install mysqli

# Expose the default HTTP port (port 80)
EXPOSE 80

# Set the working directory to the web root
WORKDIR /var/www/html/src

# Start the Apache web server when the container starts
CMD ["apache2-foreground"]
