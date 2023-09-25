## Descripción 

Plataforma web para administrar las citas de un Gimnasio de artes marciales.

## Instrucciones 

Para configurar la plataforma en un entorno local seguir los siguientes pasos:

- Clonar el proyecto con el siguiente comando: ```git clone https://github.com/JesusMartinezLucas/gym-system.git```
- Crear una base de datos en MySQL con el nombre indicado en el archivo .env 
- Para crear las tablas en la base de datos correr el siguiente comando ```php artisan migrate```   
- Para crear el usuario administrador por defecto, correr el siguiente comando: ```php artisan db:seed --class=UserSeeder```
- Para empezar a usar la plataforma correr el siguiente comando: ```php artisan serve```

# Nota

El correo del usuario administrador por defecto es <mark>arturo@arturo.com</mark> y la contraseña es <mark>password</mark>, los datos del usuario de pueden cambiar dando click en la esquina superior derecha en el nombre del usuario.