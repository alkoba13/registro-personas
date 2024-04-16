# Introducción
API Es un proyecto montado sobre la version 11.3.x de laravel

# Dependencias
* PHP 8.3
  * Composer
* [Docker-desktop](https://www.docker.com/products/docker-desktop/)
* [Node 21.7.2](https://nodejs.org/en/download)
* [swagger](https://github.com/DarkaOnLine/L5-Swagger)
* [Angular 17.3.0](https://angular.io/tutorial/tour-of-heroes/toh-pt0)


**Antes de comenzar debes de instalar docker-desktop**

Una vez instalado e iniciado el  servicio de docker-desktop, puede iniciar los contenedores para el api y la base de daos

```bash
docker compose up
```

**Si no se utiliza docker compose deberas ejecutar instalar las dependencias de laravel de forma manual**

```bash
composer install
```

## Variables de entorno

Para que los proyectos accedan a la bd de usamos los siguentes datos en api/.env de laravel
Para acceder a la BD desde fuera del contenedor solo cambia el puerto por *33069*
Aqui lleva tambien las varaibles para configurar swagger y copomex

```bash
DB_CONNECTION=mysql
DB_HOST=my_mysql
DB_PORT=3306
DB_DATABASE=mtest
DB_USERNAME=root
DB_PASSWORD=pwd

L5_SWAGGER_CONST_HOST=${APP_URL}
L5_SWAGGER_GENERATE_ALWAYS=true

COPOMEX_HOST=https://api.copomex.com/query
COPOMEX_API_KEI=28543322-6c41-45e6-8956-3da4eb7f1b6c
```

una vez configuradas las variables de entono debes de correr las migraciones, para que la base de datos se inicialice

```bash
php artisan migrate
```

y accedemos por la ruta *localhost* para acceder al proyecto
añdes */api/documentation* a la ruta para entrar a *swagger*


Existe un archivo Helpers.php en la raiz de la carpeta app/, aqui podras encontrar las funciones funciones personalizadas del proyecto

**NOTA** Si se modifica el arhico Helpers.php debes ejecutar:

```bash
composer dump-autoload
```

Para el Proyecto de *Angular*, se encuentra en la carpeta app, debes de ejecutar lo siguientes

```bash
npm install || yarn install
npm run start
```