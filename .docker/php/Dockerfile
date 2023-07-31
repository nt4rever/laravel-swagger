FROM php:8.2.0-fpm

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update

# Install useful tools
RUN apt-get -y install apt-utils nano wget dialog vim

# Install important libraries
RUN apt-get -y install --fix-missing \
    apt-utils \
    build-essential \
    git \
    curl \
    libcurl4 \
    libcurl4-openssl-dev \
    zlib1g-dev \
    libzip-dev \
    zip \
    libbz2-dev \
    locales \
    libmcrypt-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    supervisor \
    cron

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install \
    exif \
    pcntl \
    bcmath \
    ctype \
    curl \
    iconv \
    xml \
    soap \
    pcntl \
    mbstring \
    # tokenizer \
    bz2 \
    zip \
    intl \
    opcache

# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

ADD ./.docker/php/supervisord.conf /etc/supervisord.conf
ADD ./.docker/php/setup.sh /var/www/setup.sh
ADD ./.docker/php/cron.root /var/www/cron.root

RUN mkdir -p /etc/supervisor/logs
RUN chmod 755 /etc/supervisord.conf
RUN crontab /var/www/cron.root

CMD ["/usr/bin/supervisord"]
