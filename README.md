
# To Do List - Laravel Vue Vite

Aplicacion de lista de tareas.




## Requisitos

Obligatorios
 - PHP ^8.0.2
 - Composer
 - Node ^16
 - NPM ^7.10
 - MySQL

Opcionales, si ya cuenta con un servidor Apache no es necesario
 - XAMPP
 Si no cuenta con todo los requisitos la APP puede que no pueda funcionar correctamente.
## Instalación

Instalamos todas las dependencias de Laravel

```bash
  composer install --no-dev
```

Instalamos toda las dependencias de Node

```bash
  npm install
``` 
## Configuracion

Bien ahora necesitamos configurar la base de datos, para ello necesitamos copiar el archivo `.env.example`
y renombrarlo a `.env`

Ahora con el terminar posicionado en nuestro proyecto ejecutamos el siguiente comando para generar la `APP_KEY` de Laravel
```bash
  php artisan key:generate
``` 
Pasamos a configurar la DB(Base de datos) del proyecto, para ello debemos crear una DB con el nombre que desee.
En nuestro archivo .env configurar las variables de entorno de la DB de esta forma.

- `DB_DATABASE=`Aqui va el nombre que eligio de la DB
- `DB_USERNAME=`root(si esta usando xampp deje el valor que esta por defecto)
- `DB_PASSWORD=`Aqui va la contraseña que eligio de la DB si usa xampp deje el campo vacio

Una vez configurado las variables de entorno de Laravel procedemos a crear nuestras tablas de la DB, para ello necesitamos ejecutar el comando artisan
```bash
  php artisan migrate
``` 
## Desplegar

Para desplegar la APP abrimos 2 terminales en el proyecto.
En el primero levantamos el servidor backend de Laravel con el comando
```bash
  php artisan serve
``` 
Le aparecera el mensaje de confirmacion como el siguiente

`Server running on [http://127.0.0.1:8000]`

Ahora en el otro terminal necesitamos levantar el compilador de desarrollo de frontend con el comando
```bash
  npm run dev
``` 
Le aparecera el mensaje de confirmacion como el siguiente

`VITE v3.1.7  ready in 431 ms`

`➜  Local:   http://127.0.0.1:5173/`

`➜  Network: use --host to expose`

`LARAVEL v9.35.1  plugin v0.6.1`

`➜  APP_URL: http://localhost:8000`

Con ello ya tenemos desplegada la APP en ambiente local y podemos visitar la APP por medio del link
`http://localhost:8000` o `http://127.0.0.1:8000`.
