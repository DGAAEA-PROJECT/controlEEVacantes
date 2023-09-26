# Control de Experiencias Educativas Vacantes

<p align="center"><a href="https://www.uv.mx/economicoa/" target="_blank"><img src="http://colaboracion.uv.mx/afbg-combas/imagenespublicas/Flor1024x768SinFondo.png" width="200" alt="Universidad Veracruzana"></a></p>

<h1 align="center">
Control de Experiencias Educativas Vacantes
</h1>

## Descripción

<p align="justify">
El sitio web auxiliará al Área Académica Económico - Administrativa en el proceso de la gestión del control de las experiencias educativas vacantes, solicitadas por las diversas dependencias pertenecientes al área a lo largo del semestre.
    
</p>

## Requisitos

- [Laravel 9](https://laravel.com/docs/9.x/releases)
- [PHP 8.0 - 8.2](https://www.php.net/downloads) o [XAMPP ](https://www.apachefriends.org/es/download.html)
- [SQLServer ](https://www.microsoft.com/es-mx/sql-server/sql-server-downloads?rtc=1) Nota: El SQLServer debe descargarse el modo desarrollador e instalar la forma personalizada.
- [SQLServer Managment Studio](https://learn.microsoft.com/es-es/sql/ssms/download-sql-server-management-studio-ssms?redirectedfrom=MSDN&view=sql-server-ver16)
- [Drivers SQLServer](https://learn.microsoft.com/en-us/sql/connect/odbc/download-odbc-driver-for-sql-server?view=sql-server-ver15)
- [Node](https://nodejs.org/en/download)
- [Git](https://git-scm.com/downloads)
- [Composer](https://getcomposer.org/download/)

###### Ayuda adicional
[Cómo instalar y configurar SQL Server 2019](https://youtu.be/YOaC_TyOrdk)
[Conectando SQLServer con Laravel](https://www.youtube.com/watch?v=Poj5Kz6zZIA)

##### Opcional
- [PhpStorm](https://www.jetbrains.com/es-es/phpstorm/)

## Clonando el repositorio

Una vez clonado el repositorio deberas hacer lo siguiente:

1. Copiar el archivo env.example y renombrarlo como .env
2. Ejecutar<b><i>php artisan key:generate</i></b>
3. Instalar las dependencias de composer ejecutando <b><i>composer install</i></b>
4. Instalar las dependencias de NPM ejecutando <b><i>npm install</i></b>
5. Crear la base de datos  <b><i>controleevacantes </i></b> en SQLServer.
6. Realizar la migración ejecutando <b><i>php artisan migrate</i></b>
7. Iniciar el servidor de Laravel ejecutando <b><i>php artisan serve</i></b>
8. Iniciar el servidor de Node ejecutando <b><i>npm run dev</i></b>

###### Ayuda adicional
[Introducción a Artisan](https://laravel.com/docs/9.x/artisan#introduction)
[Comandos básicos de Artisan](https://jrgonzalez.es/guia-comandos-artisan)

## Flowbite

[Flowbite](https://flowbite.com/docs/getting-started/introduction/) es un plugin que puede ser incluido en los proyectos de Tailwind.
Flowbite fue usada para la creación de componentes en las vistas de la aplicación.

## Despliegue

Para realizar el despliegue o deployment se optó por Azure, debido a que Azure brinda alojamiento, base de datos y almacenamiento de archivos.

[Creación de servidor y base de datos en Azure](https://youtu.be/MLFU3CkOd1o)
[NGINX](https://laravel.com/docs/9.x/deployment#nginx)
[Añadiendo Blob Storage en Azure](https://www.jhanley.com/blog/laravel-adding-azure-blob-storage/)

## Documentación técnica

- [Lista de casos de uso, diagrama entidad - asociación y diagrama de clases ](https://drive.google.com/file/d/1FfCBYKxhVCDCc5jiQlSBOeNFUO6XY7JP/view?usp=sharing)
- [Descripción de casos de uso](https://drive.google.com/drive/folders/1gxtZjq4dU8hbj77NAcJ9jzURyuYFoI9l?usp=sharing)

## Video Tutoriales

- Videos para DGAAEA: https://www.youtube.com/playlist?list=PLkQwTdgiXHj6h7KiC7hZ-0h7h4IagCzxE
- Videos para Facultad: https://www.youtube.com/playlist?list=PLkQwTdgiXHj5o4CIYSaXVx2xOz9XmSzxQ 

## Tareas futuras

- Que los usuarios puedan trabajar en periodos distintos.
- Ajustar el límite de subida de archivos en el servidor para evitar el error 413 Request Entity Too Large.
