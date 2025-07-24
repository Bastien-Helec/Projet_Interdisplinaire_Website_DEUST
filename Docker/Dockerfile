# Docker/Dockerfile

FROM php:8.3-apache

RUN apt-get update && apt-get upgrade -y

# Extensions PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Outils utiles
RUN apt-get install -y nano curl tree

# Activer mod_rewrite
RUN a2enmod rewrite

# Autoriser les .htaccess
RUN echo '<Directory /var/www/html>\n\
    AllowOverride All\n\
</Directory>' > /etc/apache2/conf-available/allow-override.conf \
    && a2enconf allow-override

EXPOSE 80
