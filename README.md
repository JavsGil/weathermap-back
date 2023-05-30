# Nombre del Proyecto
weathermap-back
## Descripción
Microservicio que se conecta con api de gestion del tiempo.


## Requisitos Previos
- PHP (7.3.29 )
- Composer (2.5.7)
- Base de datos (MySQL)
- API Key de WeatherMap (obtener en [https://openweathermap.org/](https://openweathermap.org/))

## Pasos para Levantar el Proyecto

1. Clonar el repositorio en tu máquina local

2. Instalar las dependencias del proyecto utilizando Composer:`composer install`

3. Copiar el archivo `.env.example` y renombrarlo como `.env`. Asegúrate de configurar adecuadamente las variables de entorno en el archivo `.env`, incluyendo la configuración de la base de datos y la API Key de WeatherMap.

4. Ejecutar las migraciones para crear las tablas en la base de datos:`weathermap`


5. Levantar el servidor local:`php artisan serve`


Una vez que el servidor se haya iniciado correctamente, podrás acceder a la aplicación en tu navegador a través de la URL proporcionada por Laravel.






