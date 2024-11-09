# Use the official PHP image with Apache as the base image
FROM php:8.0-apache

# Copy your application files to the appropriate directory
COPY ./src /var/www/html/

# Expose the default HTTP port (port 80)
EXPOSE 80

# Enable the rewrite module (assuming your PHP application uses URL rewriting)
RUN a2enmod rewrite

# Install any necessary PHP extensions or dependencies here (if needed)
# For example, if you use database connections, you might need to install relevant extensions.

# Set the working directory to the web root
WORKDIR /var/www/html/

# Start the Apache web server when the container starts
CMD ["apache2-foreground"]