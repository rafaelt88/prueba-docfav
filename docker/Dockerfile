# Utiliza una imagen base de Ubuntu 20.04
FROM ubuntu:20.04

# Evita preguntas interactivas durante la instalación
ARG DEBIAN_FRONTEND=noninteractive

# Instala PHP 8.2 y los módulos de PHP 8.2 necesarios
RUN apt-get update && apt-get install -y software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt-get update && \
    apt-get install -y php8.2 php8.2-cli php8.2-common php8.2-mysql php8.2-uuid php8.2-xml zip unzip curl && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establece el directorio de trabajo
WORKDIR /var/www/

# Borra vendor y composer.lock antes de instalar las dependencias
RUN rm -rf vendor composer.lock

# Instala las dependencias de Composer
RUN composer install

# Expón el puerto 80
EXPOSE 80

# Inicia el servidor PHP
CMD ["php", "-S", "0.0.0.0:80", "-t", "/var/www/public"]