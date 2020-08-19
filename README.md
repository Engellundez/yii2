<h1 align="center">Tutorial y proyectos en laravel desde cero</h1>
<h3>Crear nuevo proyecto</h3>
<p>Para crar un nuevo proyecto de laravel lo primero que debes de descargar composer</p>
<p>para instalarlo debemos correr el siguiente comando</p>

```bash
composer global require laravel/installer
```

<p>despues de esto vamos a correr el siguiente comando para poder crear nuestro proyecto</p>

```bash
laravel new <nombre>
```
<h3>Crear Autenticacion</h3>
<p>ya que se alla instalado el proyecto podemos verlo en el aid de tu preferencia en mi caso yo voy a usar <b>Visual Studio Code</b> por su practicidad y facilidad de uso</p>
<p>ahora lo que sigue es instalarle la autenticación para que cuente con usuarios usando los siguientes comandos</p>

```bash
cd <nombre>

composer require laravel/ui

php artisan ui vue --auth
```
<p>Ahora vamos a correr los siguientes 2 comandos</p>

```bash
npm install

npm run dev
```

<p>Ahora podemos ver que nuestro proyecto ahora tienen varios archivos nuevos y si lo vemos ya corriendo en la web que tiene la opcion para agregar nuevos usuarios y te pide que inicies sesion para que puedas entrar a la ruta <b>home</b></p>
<h3>Crear Roles y permisos</h3>

<p>Para crear roles podemos ir a la documentacion de laravel al apartado de <me>middleware</me> pero en este tutorial vamos a hacer uso de un paquete de roles y servicios que se llama <a href="https://github.com/spatie/laravel-permission"><b>Spatie laravel Permission</b></a> para facilitar esta parte</p>
<p>para instalar este paquete usaremos el siguiente comando:</p>

```bash
composer require spatie/laravel-permission
```

<p>Una vez que se termine de instalar el siguiente paso es agregarlo a la configuracion de laravel como un proveedor de la siguiente forma</p>
<p>Entraremos a <em>Config/app.php</emm> y en la parte de <b><em>providers</em></b> hasta abajo agregaremos el comando</p>

```php
Spatie\Permission\PermissionServiceProvider::class,
```

<p>Ya con la linea agregada lo siguiente que haremos es correr el siguiente comando:</p>

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

<p>Esto para que tengamos la migración adecuada en nuestro proyecto y a demas tener tambien nuestro archivo de nombre <b>permission.php</b> en nuestra carpeta de configuración.</p>

<p>Además de este comando correremos tambien los siguientes 3 comandos para que la configuración de <em>app.php</em> tambien se actualice a la par.</p>

```bash
php artisan config:cache

php artisan config:clear

php artisan cache:clear
```

<p>Ahora solo modificaremos la migración para que tenga descripción ya que no cuenta con ella y unos <em>seeders</em> para que se lleve de una vez algunos roles y permisos que van a existir (esto se puede hacer hasta que todo el proyecto este definido).</p>
<p>Una vez definido los Usuarios que usaran el sistema y los roles y permisos existentes vamos a ejecutar el siguiente comando:</p>

```bash
php artisan migrate:fresh --seed
```

<p>Ahora podremos observar en nuestra base de datos no solo las 5 tablas que agrega el modulo de roles y permisos, si no que además si nos vamos al diseñador de bases de datos podemos ver que estan relacionadas adecuadamanete, a excepcion del Usuario. <b>¿Porqué?. Cuestion de nombre solamente</b></p>

<h3>Trabajar con Middlewares</h3>
<p>Para poder trabajar con middlewares es necesario ponerle un alias a nuestro middleware para poder llamar sin ningun tipo de problema lo primero que haremos es entrar al archivo `app/Http/Kernel.php` `can` lo que agregaremos es el siguiente codigo:</p>

```php
protected $routeMiddleware = [
    // ...
    'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
    'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
    'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
];
```

<p>Una vez puesto el codigo podremos llamarlo en el archivo `app/routes/web.php` agregando el middleware como se muestra en el siguiente ejemplo</p>

```php
//ejemplo
Route::get('/home', 'HomeController@index')->name('home')->middleware('role:Invitado|Super Admin');

//por agregar

//Para roles
->middleware('role:<rol1>|<rol2>');

//Para Permisos
->middleware('permission:<permiso1>|<permiso2>');

//Para ambos
->middleware('role_or_permission:<rol1>|<permiso1>|<permiso2><rol2>');
//realmente no importa el orden siempre que sea separado por un '|' para diferenciar todo

```
