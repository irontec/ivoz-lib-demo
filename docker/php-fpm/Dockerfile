FROM debian:bookworm

USER root
WORKDIR /opt/symfony

RUN echo "postfix postfix/mailname string demo.irontec.com" | debconf-set-selections
RUN echo "postfix postfix/main_mailer_type string DEMO" | debconf-set-selections
RUN apt-get update && apt-get install --assume-yes --force-yes \
        sudo \
        gettext \
        composer \
        make \
        git \
        unzip \
        curl \
        percona-toolkit \
        sqlite3 \
        php8.2 \
        php8.2-cli \
        php8.2-mysql \
        php8.2-xml \
        php8.2-gd \
        php8.2-mbstring \
        php8.2-sqlite3 \
        php8.2-redis \
        php8.2-igbinary \
        php8.2-curl \
        php8.2-yaml \
        php8.2-fpm \
        php8.2-mailparse \
        php8.2-imagick \
        php8.2-xdebug \
        php8.2-zip \
        php8.2-ldap \
        iputils-ping \
        python3\
        pip\
        vim \
        iproute2 \
        apache2 \
        postfix \
        default-mysql-client \

RUN apt-get clean

RUN /bin/sed -i 's/^smtp_tls_security_level=.*/smtp_tls_security_level=none/g'   /etc/postfix/main.cf
RUN  /bin/sed -i 's/^smtpd_tls_security_level=.*/smtpd_tls_security_level=none/g' /etc/postfix/main.cf

ENV PHP_IDE_CONFIG="serverName=demo-fpm"

RUN mkdir -p /var/run/php

ADD docker/php-fpm/start.sh /var/run
RUN chmod +x /var/run/start.sh

############
## APACHE ##
############
ADD docker/php-fpm/010-web.conf /etc/apache2/sites-available/010-web.conf
ADD docker/php-fpm/020-api.conf /etc/apache2/sites-available/020-api.conf

# Disable not required apache modules
RUN /usr/sbin/a2dismod -q mpm_prefork
RUN /usr/sbin/a2dismod -q mpm_worker

# Enable required apache modules
RUN /usr/sbin/a2enmod -q mpm_event
RUN /usr/sbin/a2enmod -q http2
RUN /usr/sbin/a2enmod -q headers
RUN /usr/sbin/a2enmod -q rewrite
RUN /usr/sbin/a2enmod -q ssl
RUN /usr/sbin/a2enmod -q proxy
RUN /usr/sbin/a2enmod -q proxy_http
RUN /usr/sbin/a2enmod -q proxy_wstunnel
RUN /usr/sbin/a2enmod -q proxy_fcgi setenvif

# Enable required apache configuration
RUN /usr/sbin/a2enconf -q php8.2-fpm

RUN /usr/sbin/a2dissite -q 000-default
RUN /usr/sbin/a2ensite -q 010-web.conf
RUN /usr/sbin/a2ensite -q 020-api.conf

############
## PHP ##
############
ADD docker/php-fpm/xdebug.ini /etc/php/8.2/fpm/conf.d/20-xdebug.ini

CMD [ "/bin/bash", "/var/run/start.sh"]

RUN useradd -m docker && echo "docker:docker" | chpasswd
RUN adduser docker sudo
