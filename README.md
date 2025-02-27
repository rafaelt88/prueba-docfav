# Aplicación de Prueba Docfav

Este proyecto es una aplicación PHP containerizada utilizando Docker y gestionada con Docker Compose. Incluye un servidor de aplicaciones PHP y una base de datos MySQL.

## Requisitos Previos

Antes de comenzar, asegúrate de tener instalado lo siguiente en tu máquina:

- Docker
- Docker Compose

## Estructura del Proyecto

El proyecto está estructurado de la siguiente manera:

- `bin/`: Contiene archivos binarios.
- `config/`: Archivos de configuración para la aplicación.
- `public/`: Archivos accesibles públicamente (por ejemplo, `index.php`).
- `src/`: Código fuente de la aplicación PHP.
- `test/`: Archivos de prueba para la aplicación.
- `vendor/`: Dependencias de Composer.
- `docker/`: Archivos relacionados con Docker, incluyendo `docker-compose.yml` y `Dockerfile`.

## Configuración de Docker Compose

El archivo `docker-compose.yml` define los siguientes servicios:

1.  **app**: El servidor de la aplicación PHP.
    -   Se construye a partir del `Dockerfile` en la raíz del proyecto.
    -   Mapea directorios locales al contenedor para facilitar el desarrollo.
    -   Expone la aplicación en el puerto `8888`.
    -   Ejecuta un servidor PHP integrado en el puerto `80`.
2.  **db**: Una base de datos MySQL.
    -   Utiliza la imagen `mysql:8.0`.
    -   Configura la contraseña de root, la base de datos, el usuario y la contraseña.
    -   Persiste los datos en un volumen local (`./docker/data`).
3.  **adminer**: Una base de datos Adminer.
    -   Utiliza la imagen `adminer`.
    -   Expone la aplicación en el puerto `7777`.
    -   Linkeada a la base de datos mysql.

## Configuración de la Base de Datos

La configuración de la base de datos se encuentra en el archivo `config/database.php`. Este archivo define los parámetros de conexión a la base de datos MySQL que se ejecuta en el contenedor `db`.

Para unificar el proyecto y Docker, se recomienda controlar las credenciales de conexión directamente desde el archivo `.env`.

## Acceso a la Base de Datos

Para consultar los datos cargados, se ha agregado un contenedor de `adminer`, al cual puedes acceder mediante [http://localhost:7777](http://localhost:7777/?server=db&username=docfav&db=docfav).

## Instalación de la Aplicación

Para instalar la aplicación, sigue estos pasos:

1.  Clona el repositorio en tu máquina con `git clone git@github.com:rafaelt88/prueba-docfav.git`.
2.  Ejecuta `docker compose up -d` para levantar los contenedores.
3.  Ejecuta `docker exec -it php_app composer install` para instalar las dependencias del proyecto.
4.  Ejecuta `docker exec -it php_app php bin/doctrine orm:schema-tool:create` para crear las estructuras de datos.
5.  Finalmente, puedes acceder a la aplicación mediante [http://localhost:8888](http://localhost:8888).

## Despliegue de la Aplicación

Para desplegar la aplicación, sigue estos pasos:

1.  Actualiza el proyecto con `git pull`, preferiblemente utilizando la rama `master`.
2.  Ejecuta `docker exec -it php_app composer update` para actualizar las dependencias.
3.  Ejecuta `docker compose up -d` para levantar los contenedores.
4.  Finalmente, puedes acceder a la aplicación mediante [http://localhost:8888](http://localhost:8888).

La ruta `http://localhost:8888/register/user?name=<name>&email=<email>&password=<password>` proporciona una forma directa de probar el controlador de registro de usuarios. Al usar esta ruta con los parámetros adecuados, se pueden validar las reglas de negocio implementadas en el controlador y asegurar que los usuarios se registren correctamente en la base de datos.

## Comandos de Utilidad

-   `docker compose down`: Finaliza los contenedores.
-   `docker compose up -d --force-recreate --build`: Reconstruye las imágenes antes del despliegue.
-   `docker exec -it php_app ./vendor/bin/phpunit`: Ejecuta las pruebas automatizadas.
-   `docker exec -it php_app composer update`: Actualiza las dependencias del proyecto.
-   `docker exec -it php_app php bin/doctrine orm:schema-tool:update --force`: Actualiza las estructuras de datos.

## Licencia

Este proyecto está bajo la licencia [MIT](https://mit-license.org/).