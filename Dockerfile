# Image PHP 8
FROM php:8.1-fpm

# Set timezone variable
ENV PHP_TIMEZONE=UTC

# Copy file konfigurasi untuk PHP
RUN echo "memory_limit=-1" > "$PHP_INI_DIR/conf.d/memory-limit.ini" \
    && echo "date.timezone=${PHP_TIMEZONE}" > "$PHP_INI_DIR/conf.d/date_timezone.ini" \
    && echo "max_execution_time=300" > "$PHP_INI_DIR/conf.d/execution-limit.ini" 

RUN apt-get update \
    && apt-get install -y --no-install-recommends libpq-dev default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Expose the MySQL port
# EXPOSE 3306

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
