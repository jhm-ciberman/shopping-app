# Set the base image for subsequent instructions
FROM php:7.3.2

USER root

# Update packages
RUN apt-get update

# Install PHP and composer dependencies
RUN apt-get install -qq git curl libzip-dev libjpeg-dev libpng-dev libfreetype6-dev libbz2-dev

# Clear out the local repository of retrieved package files
RUN apt-get clean

# Install needed extensions
# Here you can install any other extension that you need during the test and deployment process
RUN docker-php-ext-configure gd --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install pdo_mysql bcmath zip gd exif pcntl

# Install Composer
RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node 11
RUN apt-get -y install curl gnupg
RUN curl -sL https://deb.nodesource.com/setup_11.x  | bash -
RUN apt-get -y install nodejs