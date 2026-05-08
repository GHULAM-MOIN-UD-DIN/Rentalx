FROM php:8.2-apache

# Install dependencies needed for Laravel & Node js
RUN apt-get update && apt-get install -y \
    ca-certificates \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install Node.js (v20) for Vite build
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Clear out the local repository of retrieved package files
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install required PHP extensions + opcache for performance
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd opcache

# Enable Apache mod_rewrite + mod_deflate + mod_expires + mod_headers for performance
RUN a2enmod rewrite deflate expires headers

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy the entire project to the working directory
COPY . .

# Install PHP dependencies
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader

# Install NPM dependencies and build Vite assets
RUN npm install
RUN npm run build

# Ensure correct permissions for Laravel cache and storage
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Create upload directories and set permissions
RUN mkdir -p /var/www/html/public/products/gallery \
    /var/www/html/public/car_images \
    /var/www/html/public/uploads/reviews \
    /var/www/html/public/uploads/profiles \
    /var/www/html/public/profiles \
    /var/www/html/public/covers && \
    chown -R www-data:www-data /var/www/html/public/products /var/www/html/public/car_images /var/www/html/public/uploads /var/www/html/public/profiles /var/www/html/public/covers && \
    chmod -R 775 /var/www/html/public/products /var/www/html/public/car_images /var/www/html/public/uploads /var/www/html/public/profiles /var/www/html/public/covers

# ═══════════════════════════════════════
# PERFORMANCE: PHP OPcache config
# ═══════════════════════════════════════
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.max_accelerated_files=10000" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.save_comments=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/opcache.ini

# ═══════════════════════════════════════
# PHP Upload & Memory Limits
# ═══════════════════════════════════════
RUN echo "upload_max_filesize=20M" >> /usr/local/etc/php/conf.d/uploads.ini && \
    echo "post_max_size=50M" >> /usr/local/etc/php/conf.d/uploads.ini && \
    echo "memory_limit=256M" >> /usr/local/etc/php/conf.d/uploads.ini && \
    echo "max_execution_time=120" >> /usr/local/etc/php/conf.d/uploads.ini && \
    echo "max_file_uploads=20" >> /usr/local/etc/php/conf.d/uploads.ini

# ═══════════════════════════════════════
# PERFORMANCE: Apache Compression & Caching
# ═══════════════════════════════════════
RUN echo '<IfModule mod_deflate.c>\n\
  AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css\n\
  AddOutputFilterByType DEFLATE application/javascript application/json\n\
  AddOutputFilterByType DEFLATE application/x-javascript\n\
  AddOutputFilterByType DEFLATE image/svg+xml\n\
</IfModule>\n\
<IfModule mod_expires.c>\n\
  ExpiresActive On\n\
  ExpiresByType text/css "access plus 1 year"\n\
  ExpiresByType application/javascript "access plus 1 year"\n\
  ExpiresByType image/png "access plus 1 year"\n\
  ExpiresByType image/jpeg "access plus 1 year"\n\
  ExpiresByType image/gif "access plus 1 year"\n\
  ExpiresByType image/webp "access plus 1 year"\n\
  ExpiresByType image/svg+xml "access plus 1 year"\n\
  ExpiresByType font/woff2 "access plus 1 year"\n\
  ExpiresByType font/woff "access plus 1 year"\n\
</IfModule>\n\
<IfModule mod_headers.c>\n\
  Header set X-Content-Type-Options "nosniff"\n\
  Header set X-Frame-Options "SAMEORIGIN"\n\
  <FilesMatch "\\.(css|js|png|jpg|jpeg|gif|webp|svg|woff|woff2)$">\n\
    Header set Cache-Control "public, max-age=31536000, immutable"\n\
  </FilesMatch>\n\
</IfModule>' > /etc/apache2/conf-available/performance.conf && \
    a2enconf performance

# Change Apache document root to Laravel's public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Render uses the PORT environment variable. We set a default of 80.
ENV PORT=80

# ═══════════════════════════════════════
# STARTUP: Cache at RUNTIME (not build!) + run server
# ENV vars (MAIL_*, DB_*, etc.) only available at runtime on Render
# ═══════════════════════════════════════
CMD sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf && \
    sed -i "s/<VirtualHost \*:80>/<VirtualHost \*:${PORT}>/" /etc/apache2/sites-available/000-default.conf && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php artisan db:seed --class=AdminSeeder --force && \
    apache2-foreground
