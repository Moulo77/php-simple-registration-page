FROM php:8.2-apache

COPY /php/sql/users.sql /docker-entrypoint-initdb.d/

RUN apt-get update && apt-get upgrade -y && apt-get install -y wget
RUN wget -qO /usr/src/password.php https://raw.githubusercontent.com/ircmaxell/password_compat/master/lib/password.php
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli

EXPOSE 80