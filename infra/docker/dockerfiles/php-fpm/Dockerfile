FROM php:8.1-fpm

# 必要なライブラリをインストール
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    libzip-dev # zip 

# PHPの拡張機能をインストール
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql mbstring exif pcntl bcmath xml zip

# Composerをインストール
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 作業ディレクトリを設定
WORKDIR /var/www

# アプリケーションのソースコードをコピー
COPY src/ /var/www/

# Composerを使って依存関係をインストール
RUN composer install --no-dev --optimize-autoloader

# アプリケーションキーを生成
RUN php artisan key:generate

# PHP-FPMを実行
CMD ["php-fpm"]
