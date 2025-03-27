# dockerfile using the official PHP image as a base image
FROM php:8.0-apache

# Install dependencies
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd

# Copy the project files into the container
COPY . /var/www/html/

# Set the working directory inside the container
WORKDIR /var/www/html

# Expose the Apache HTTP server port
EXPOSE 80
