# Use a imagem oficial do PHP com Apache para Laravel
FROM php:7.4-apache

# Atualize a lista de pacotes e instale as dependências necessárias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git

# Instale as extensões do PHP necessárias para o Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Ative o módulo de reescrita do Apache para permitir URLs amigáveis
RUN a2enmod rewrite

# Instale o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Defina o diretório de trabalho como /var/www/html
WORKDIR /var/www/html

# Defina o usuário do Apache como www-data (ID 33) para evitar problemas de permissões
RUN chown -R www-data:www-data /var/www/html

# Copie todos os arquivos do projeto Laravel para o contêiner
COPY ./lista-de-compras .

# Instale o Node.js e o npm
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

# Verifique se o arquivo package.json está presente
RUN if [ ! -f "package.json" ]; then echo "package.json not found"; exit 1; fi

# Instale as dependências do projeto Laravel usando o Composer
RUN composer install

# Instale as dependências do frontend com npm
RUN npm install

# Crie o arquivo de configuração do Apache para apontar para o diretório público do Laravel
RUN echo "DocumentRoot /var/www/html/public" > /etc/apache2/sites-available/000-default.conf

# Exponha a porta 80 para que o Apache seja acessível
EXPOSE 80

# Inicie o servidor Apache automaticamente
COPY ./lista-de-compras/docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]