Bienvenido a API Geomatica
===================


API para la consulta de la información de procesos de fabrica 
----------


Documentación
-------------

La aplicación se encuentra desarrollada con las siguientes tecnologías:

 * [Laravel 6.2 LTS](https://laravel.com/docs/6.2)

Configuración:
 * Crear un archivo .env y asignar la configuración necesaria.
Instalación:

    composer install
    

 * Se puede usar un modelo de tabla de usuario personalizado, por defecto se creó el modelo app/Models/User.php y todo está configurado de acuerdo a este

 * PARA PERSONALIZAR EL LOGIN CON UNA TABLA DE USUARIOS DIFERENTE:
  
 * Crear tu propio modelo de tu tabla de usuarios 
    
 * cambiar en archivo config/auth.php el modelo que se desea usar para la tabla de usuarios en la autenticación (linea 70)

    Ej: 'model' => App\Models\User::class,   

 * En el app/Http/Controllers/JWTAuthController.php se debe ajustar los campos con los cuales se hará login (usuario y contraseña) de acuerdo a la tabla del modelo
 * escogido en el paso anterior

    Ej:  $credentials = request(['email', 'password']);
