# Survey System - VIP2CARS

## Requisitos del entorno ========================================

- PHP >= 8.2
- MySQL 8 o MariaDB 10+
- Extensiones PHP: `pdo`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`
- Composer

---

## Instalación y configuración ========================================

1. Clona el repositorio:

git https://github.com/LuisRM02/survey_system.git

cd survey_system

2. Instala dependencias:
composer install

3. Compila las variables de entorno en .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=survey_system
DB_USERNAME=root
DB_PASSWORD=


## Puesta en marcha (posterior a crear la Base de Datos y el servicio de MySQL corriendo) ========================================
1. Ejecuta migraciones 
php artisan migrate

2. Levanta el servidor
php artisan serve

el proyecto estara disponible en:
http://127.0.0.1:8000

3. Instrucciones generales
    - Ve a Registrar un vehiculo
    - Completa los datos del vehiculo
    - selecciona el tipo de documento del cliente
    - digita el numero de documento del cliente
        -el sistema buscara automaticamente clientes que coincidan luego de digitar 2 numeros, si no los encuntra te pedira crearlos. Ojo, el sistema compara tanto el tipo como el numero          de documento. Ejem: Si un DNI que empieza con "987.." es buscado pero con el tipo RUC, no lo encontrara.


## Estructura de la BBDD ========================================
<img width="402" height="623" alt="DER_DBDRIAGRAM" src="https://github.com/user-attachments/assets/969f562c-f83a-4e50-8a82-d687a10b4924" />

1. Crear BD con el nombre "survey_system":
    CREATE DATABASE survey_system;

2. Seleccionar y ejecutar Script de BBDD

CREATE TABLE `clients` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `document_type` varchar(140) NOT NULL,
  `document_number` varchar(12) NOT NULL UNIQUE,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(140) UNIQUE,
  `phone_number` varchar(9) UNIQUE
);

CREATE TABLE `vehicles` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `plate` varchar(6) NOT NULL UNIQUE,
  `model` varchar(140) NOT NULL,
  `manufacturing_year` year NOT NULL,
  `client_id` int NOT NULL
);

ALTER TABLE `vehicles` 
ADD CONSTRAINT fk_clients_vehicles
FOREIGN KEY (`client_id`) 
REFERENCES `clients` (`id`);
