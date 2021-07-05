FROM php:7.4-apache

WORKDIR /var/www/html

RUN apt-get update \
    &&  apt-get -y install tzdata cron \
    && a2enmod rewrite \
    && apt-get install -y --no-install-recommends libpq-dev libicu-dev libzip-dev zip unzip git cron \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable mysqli \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN apt update \
	&& apt -y install vim

# Configurando o timezone do servidor
RUN ln -sf /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime

#RUN apt-get -y remove tzdata
RUN rm -rf /var/cache/apk/*

# Apache settings
COPY docker/servico/000-default-servico.conf /etc/apache2/sites-available/000-default.conf

COPY ./ /var/www/html/

RUN chmod 777 -R /var/www/html/

EXPOSE 80

CMD [ "sh", "-c", "/usr/local/bin/apache2-foreground;" ]