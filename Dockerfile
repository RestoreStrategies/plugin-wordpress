FROM wordpress:4.7.2-apache

MAINTAINER Joseph Simmons 'joseph@forthecity.org'
ENV REFRESHED 2016-08-15
WORKDIR "/"
RUN apt-get -y update
RUN apt-get -y dist-upgrade
RUN apt-get install -y wget mysql-client
RUN wget https://phar.phpunit.de/phpunit-5.5.0.phar
RUN chmod +x /phpunit-5.5.0.phar
RUN mv /phpunit-5.5.0.phar /usr/local/bin/phpunit
WORKDIR "/var/www/html"
VOLUME ["/var/www/html/wp-content/plugins/restore-strategies"]
EXPOSE 80
