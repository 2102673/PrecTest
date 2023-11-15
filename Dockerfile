# Use an official PHP image as the base
FROM php:7.4-apache

# Set the working directory
WORKDIR /var/www/html

# Copy PHP files from the local ./repo folder into the image
COPY ./src /var/www/html

# Install any necessary dependencies or extensions
# For example, if you need MySQL support:
# RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Expose ports (Apache default is 80)
EXPOSE 80

# Define the command to run when the container starts
CMD ["apache2-foreground"]