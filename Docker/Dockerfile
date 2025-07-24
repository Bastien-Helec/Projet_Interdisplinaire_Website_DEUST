# Utiliser une image PHP avec Apache

FROM php:8.3-apache

# Mettre à jour les paquets système pour corriger les vulnérabilités
RUN apt-get update && apt-get upgrade -y

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Installer des outils utiles (nano, curl et tree)
RUN apt-get update && apt-get install -y nano curl tree

RUN a2enmod rewrite

RUN echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    </Directory>' > /etc/apache2/sites-available/000-default.conf

# Exposer le port 80
EXPOSE 8080 80
