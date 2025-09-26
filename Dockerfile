FROM ubuntu:22.04

ENV TZ=Asia/Kolkata
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Install system dependencies
RUN apt-get update && apt-get install -y \
    software-properties-common \
    curl \
    unzip \
    git \
    nano \
    cron \
    apache2 \
    libapache2-mod-security2 \
    apt-transport-https \
    ca-certificates \
    mysql-client \
    libcurl4-openssl-dev \
    && apt-get clean

# Add PHP 8.2 repo
RUN add-apt-repository ppa:ondrej/php -y && apt-get update

# Install PHP 8.2 + extensions
RUN apt-get install -y \
    php8.2 \
    php8.2-cli \
    php8.2-common \
    php8.2-imap \
    php8.2-mbstring \
    php8.2-mysql \
    php8.2-mbstring \
    php8.2-xml \
    php8.2-curl \
    php8.2-bcmath \
    php8.2-intl \
    php8.2-zip \
    php8.2-soap \
    php8.2-xsl \
    php8.2-gd \
    php8.2-mailparse \ 
    libapache2-mod-php8.2 \
    && apt-get clean

# Enable Apache modules
RUN a2enmod rewrite headers ssl 

RUN sed -i 's/variables_order = .*/variables_order = "EGPCS"/' /etc/php/8.2/apache2/php.ini

RUN sed -i 's/variables_order = .*/variables_order = "EGPCS"/' /etc/php/8.2/cli/php.ini


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# ---- Install Node.js 18.x and npm ----
#RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
#    apt-get install -y nodejs
# Set working directory

WORKDIR /var/www/html

RUN mkdir tests database

COPY tests tests/

COPY database database/

# Copy app files
COPY composer.json /var/www/html/
COPY . /var/www/html

# Copy environment and Apache config
COPY docker/docker.env /var/www/html/.env
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/apache2.conf /etc/apache2/apache2.conf

# Copy PHP configuration
#COPY docker/php.ini /etc/php/8.2/apache2/php.ini

# Entrypoint script
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Install PHP dependencies
RUN composer install 
#    npm install && \
#    npm run build

EXPOSE 80 443

CMD ["/entrypoint.sh"] 
