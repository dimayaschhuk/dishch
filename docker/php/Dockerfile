FROM php:7.3.1-fpm

RUN apt-get update

RUN docker-php-ext-install \
	pdo_mysql 

RUN apt-get update && apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
		git \
		libzip-dev \
		zip \
		nano \
	&& docker-php-ext-install -j$(nproc) iconv \
	&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
	&& docker-php-ext-install -j$(nproc) gd \
	&& docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install -j$(nproc) zip



RUN apt-get update && apt-get install -y --fix-missing \
    apt-utils \
    gnupg

RUN echo "deb http://packages.dotdeb.org jessie all" >> /etc/apt/sources.list
RUN echo "deb-src http://packages.dotdeb.org jessie all" >> /etc/apt/sources.list
RUN curl -sS --insecure https://www.dotdeb.org/dotdeb.gpg | apt-key add -

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev
RUN docker-php-ext-install zip

RUN curl -sS https://docker-hosting.srv.mhp.com.ua/getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version