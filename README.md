# Crypto Currencies

## English

A simple app that shows 5 cryptocurrencies

### Requirements to run the project

- PHP
- Composer
- NodeJS

### Instructions

To start the project first rename **.env.example** to **.env** and create a file in the *database* folder called **database.sqlite**. Then run:

```
composer install
npm install
```

Then generate the app key:

```
php artisan key:generate
```

And finally run the server and the vite styles with:

```
php artisan serve
npm run dev
```
**IMPORTANT**: If laravel throws a curl error you may have to disable your antivirus

## Español

Una aplicación sencilla que muestra 5 criptomonedas

### Requisitos para ejecutar el proyecto

- PHP
- Composer
- NodeJS

## Instrucciones

Para iniciar el proyecto, primero renombra **.env.example** a **.env** y crea un archivo en la carpeta de *database* llamado **database.sqlite**. Luego ejecuta:

```
composer install
npm install
```

Luego genera la clave de la aplicación:

```
php artisan key:generate
```

Y finalmente ejecuta el servidor y los estilos de vite con:
```
php artisan serve
npm run dev
```

**IMPORTANTE**: Si laravel lanza un error de curl, es posible que debas desactivar tu antivirus
