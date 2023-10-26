#FROM php:7.4-apache
FROM php:8.2-apache

# Add Laravel necessary php extensions
RUN apt-get update && apt-get install -y \
    python3.10 \
    python3-pip \
    libzip-dev \
    unzip \
    zip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libgmp-dev \
    libonig-dev \
    && docker-php-ext-install -j$(nproc) zip mysqli pdo_mysql gmp mbstring \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

RUN apt-get install -y ssl-cert
RUN apt-get install -y openssl

# GRAFIKUS FÁJL SZERKESZTŐ TELEPÍTÉSE
RUN apt-get install -y mcedit

# Install curl and tar
RUN apt-get install -y curl tar

#RUN apt-get update && apt-get install -y locales && rm -rf /var/lib/apt/lists/* \
#    && localedef -i en_US -c -f UTF-8 -A /usr/share/locale/locale.alias en_US.UTF-8
#ENV LANG en_US.utf8
#ENV DEBIAN_FRONTEND noninteractive

RUN mkdir -p /var/www/csiha
ENV APACHE_DOCUMENT_ROOT /var/www/csiha/public
ENV APP_NAME "csiha"

COPY --from=composer:2.4.0 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/csiha/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite

RUN service apache2 restart

EXPOSE 80
