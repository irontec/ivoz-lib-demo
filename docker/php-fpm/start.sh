# /bin/bash!

#####################
## postfix
#####################
service postfix start

sed -i "s/APP_ENV \"prod\"/APP_ENV \"$APP_ENV\"/" /etc/apache2/sites-available/020-api.conf

#####################
## apache
#####################
service apache2 start

#####################
## project dependencies
#####################
composer install

if [ ! -f /opt/symfony/config/jwt/certificate/private.pem ]; then
  bin/console lexik:jwt:generate-keypair
fi

#####################
## /etc/hosts
#####################
/sbin/ip route|awk '/default/ { print $3 "      xdebug" }' >> /etc/hosts

#####################
## fpm
#####################
/usr/sbin/php-fpm8.2 --fpm-config /etc/php/8.2/fpm/php-fpm.conf --nodaemonize

##########################################
## Python packages Installation
##########################################
pip install reformat-gherkin