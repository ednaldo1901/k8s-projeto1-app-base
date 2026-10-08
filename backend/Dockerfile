FROM php:8.2-apache

# Atualiza os pacotes e instala dependências do sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Instala extensões PHP essenciais
RUN docker-php-ext-install \
    mysqli \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    xml \
    gd \
    opcache

# Habilita o mod_rewrite do Apache
RUN a2enmod rewrite

# Silencia warning de ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Configura o DocumentRoot do Apache para /var/www/html/public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Permite .htaccess
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' \
    /etc/apache2/apache2.conf

RUN sed -i 's/DirectoryIndex index.php index.html/DirectoryIndex index.html index.php/' /etc/apache2/conf-available/docker-php.conf

# Cria o diretório public e copia os arquivos
WORKDIR /var/www/html
RUN mkdir -p /var/www/html/public
COPY conexao.php /var/www/html/public/
COPY index.php /var/www/html/public/
COPY index.html   /var/www/html/public/
COPY js.js        /var/www/html/public/
COPY css.css      /var/www/html/public/

# Permissões corretas para o Apache (www-data)
RUN chown -R www-data:www-data /var/www/html/public && \
    chmod -R 755 /var/www/html/public

EXPOSE 80

CMD ["apache2-foreground"]