# Aplicacion de prueba docfav.

Este proyecto es una aplicación PHP que está containerizada usando Docker y gestionada con Docker Compose. Incluye un servidor de aplicaciones PHP y una base de datos MySQL.

## Requisitos previos

Antes de comenzar, asegúrate de tener instalado lo siguiente en tu máquina:

- Docker
- Docker Compose

## Estructura del proyecto

El proyecto está estructurado de la siguiente manera:

- `bin/`: Contiene archivos binarios.
- `config/`: Archivos de configuración para la aplicación.
- `public/`: Archivos accesibles públicamente (por ejemplo, `index.php`).
- `src/`: Código fuente de la aplicación PHP.
- `test/`: Archivos de prueba para la aplicación.
- `vendor/`: Dependencias de Composer.
- `docker/`: Archivos relacionados con Docker, incluyendo `docker-compose.yml` y `Dockerfile`.

## Configuración de Docker Compose

El archivo `docker-compose.yml` define dos servicios:

1. **app**: El servidor de la aplicación PHP.
   - Se construye a partir del `Dockerfile` en la raíz del proyecto.
   - Mapea directorios locales al contenedor para facilitar el desarrollo.
   - Expone la aplicación en el puerto `8080`.
   - Ejecuta un servidor PHP integrado en el puerto `80`.

2. **db**: Una base de datos MySQL.
   - Utiliza la imagen `mysql:8.0`.
   - Configura la contraseña de root, la base de datos, el usuario y la contraseña.
   - Persiste los datos en un volumen local (`./docker/data`).
   
## Configuración de la base de datos

La configuración de la base de datos se encuentra en el archivo `config/database.php`. Este archivo define los parámetros de conexión a la base de datos MySQL que se ejecuta en el contenedor db.

Para efectos de unificación del proyecto y docker, se recomienda controlar las credenciales de la conexión directamente desde el fichero `.env`.

## Instalar la aplicación

Para instalar la aplicación, sigue estos pasos:

1. Clona este repositorio en tu máquina local.
2. Utilizando `composer install` instala las dependencias.

## Desplegar la aplicación

Para desplegar la aplicación, sigue estos pasos:

1. Actualiza el proyecto de preferencia en la rama `master` con `git pull`.
2. Utilizando `composer update` actualiza las dependencias.
3. Ejecuta `docker compose up -d` comando para levantar los contenedores.
4. Una vez que los contenedores estén en ejecución, puedes acceder a la aplicación en tu navegador web a través del [http://localhost:8080](http://localhost:8080).

## Detener la aplicación

Para detener y eliminar los contenedores, ejecuta el comando `docker compose down`.

## Consola de Doctrine.

El proyecto utiliza Doctrine, una herramienta de mapeo objeto-relacional (ORM) para PHP, que facilita la interacción con la base de datos. El comando php bin/doctrine es una interfaz de línea de comandos (CLI) que permite ejecutar diversas tareas relacionadas con la base de datos, como la creación de esquemas, migraciones y más.

## Licencia
Este proyecto está bajo la licencia [MIT](https://mit-license.org/).

