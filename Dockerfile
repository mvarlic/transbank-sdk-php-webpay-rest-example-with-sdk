FROM php:7.4-apache-buster
RUN apt-get update && apt-get install -y zip unzip zlib1g-dev wget libzip-dev
RUN docker-php-ext-install zip
RUN mkdir -p /app
WORKDIR /app
COPY ./composer* /app/
RUN sed -i 's/CipherString = DEFAULT@SECLEVEL=1/' /etc/ssl/openssl.cnf
RUN composer clearcache
RUN rm -rf vendor/*
RUN chmod 0777 ./composer-install.sh
RUN ./composer-install.sh
COPY . /app
RUN cp .env.example .env

