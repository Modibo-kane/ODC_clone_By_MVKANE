# Utilise une image officielle PHP avec Apache
FROM php:8.1-apache

# Copie le contenu de ton projet dans le dossier du serveur web
COPY . /var/www/html/

# Donne les droits nécessaires
RUN chown -R www-data:www-data /var/www/html

# Active le module Apache pour les fichiers .htaccess (si besoin)
RUN a2enmod rewrite

# Expose le port 80
EXPOSE 8080
