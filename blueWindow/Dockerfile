# An official PHP with Apache sample from DockerHub is used
FROM php:8.0-apache

# Copy the application files to the container
COPY .. /var/www/html/

# ИInstalling additional libraries and modules
RUN docker-php-ext-install mysqli pdo_mysql

# Exposing port 80 so that the application can be accessed externally
EXPOSE 80

