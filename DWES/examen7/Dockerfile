FROM php:8.0.0-apache

RUN apt-get update \

 && apt-get  install -y apt-utils \

 && apt-get install -y build-essential \

 && apt-get install -y sendmail libpng-dev \

 && apt-get install -y libzip-dev \

 && apt-get install -y libfreetype6-dev \

 && apt-get install -y locales \

 && apt-get install -y zlib1g-dev \

 && apt-get install -y libonig-dev \

 && echo "deb http://ftp.de.debian.org/debian buster main" >> /etc/apt/sources.list \

 && apt-get update &&  apt-get install -y libpq-dev \

 && rm -rf /var/lib/apt/lists* \

 && docker-php-ext-install zip

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql

RUN docker-php-ext-install gd mbstring pgsql pdo pdo_pgsql exif pcntl

RUN a2enmod rewrite
