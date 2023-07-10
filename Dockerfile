FROM php:7.4-apache
WORKDIR /var/www/html

ADD fpwebsite.conf /etc/apache2/sites-available/fpwebsite.conf

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN a2enmod rewrite && \
    a2dissite 000-default && \
    a2ensite fpwebsite && \
    service apache2 restart

ADD . /var/www/html/

EXPOSE 80