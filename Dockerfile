# Use PHP 8.4 image with Apache
FROM php:8.4-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    unzip \
    libicu-dev \
    libxslt1-dev \
    libpq-dev \
    libsqlite3-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    libxpm-dev \
    autoconf \
    g++ \
    make \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions required for Bagisto/Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm \
    && docker-php-ext-install -j$(nproc) \
    bcmath \
    calendar \
    ctype \
    curl \
    dom \
    exif \
    fileinfo \
    gd \
    intl \
    mbstring \
    opcache \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    pdo_sqlite \
    pcntl \
    xml \
    xsl \
    zip

# Install Redis extension
RUN pecl install redis \
    && docker-php-ext-enable redis

# Install Composer version 2.9.2
COPY --from=composer:2.9.2 /usr/bin/composer /usr/bin/composer

# Install Node.js and npm using setup script
RUN apt-get update && apt-get install -y ca-certificates curl \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# Verify installation
RUN node -v && npm -v

# Enable Apache mod_rewrite
RUN a2enmod rewrite headers

# Configure Apache
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Copy application files (copy after dependencies to leverage Docker cache)
COPY . /var/www/html

# Copy entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Create necessary directories after copy
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache

# Set environment first (needed for composer install)
RUN cp .env.example .env || true

# Set proper permissions before composer install
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 777 storage \
    && chmod -R 777 bootstrap/cache

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev \
    --no-scripts

# Generate application key
RUN php artisan key:generate --ansi || true

# Run post-install scripts manually
RUN php artisan package:discover --ansi || true

# Clear and cache configuration
RUN php artisan config:cache || true \
    && php artisan route:cache || true \
    && php artisan view:cache || true

# Install Node dependencies and build assets
RUN npm install && npm run build

# Set proper permissions again
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Configure PHP settings
RUN echo "memory_limit=256M" > /usr/local/etc/php/conf.d/memory.ini \
    && echo "upload_max_filesize=100M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size=100M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_execution_time=300" > /usr/local/etc/php/conf.d/execution.ini \
    && echo "error_reporting=E_ALL & ~E_DEPRECATED" > /usr/local/etc/php/conf.d/deprecation.ini

# Expose port 80
EXPOSE 80

# Set entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

# Start Apache in foreground
CMD ["apache2-foreground"]
