FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    sudo \
    zip \
    unzip \
    netcat

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*


# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Redis extension
RUN pecl install redis && \
    docker-php-ext-enable redis


# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Deployment steps
COPY . .

COPY .env.example .env

RUN composer install --optimize-autoloader --no-dev
RUN chown -R $user:$user \
    /var/www/storage \
    /var/www/bootstrap/cache \
    /var/www/run.sh

USER $user

RUN php artisan key:generate

COPY run.sh .

# RUN chmod +x run.sh

# CMD ["sh", "run.sh"]

ENTRYPOINT ["./run.sh"]
CMD ["php-fpm"]

# CMD /bin/sh -c "./run.sh && tail -f /dev/null"

# CMD ["php-fpm"]

