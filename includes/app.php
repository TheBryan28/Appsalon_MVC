<?php 
require __DIR__ . '/../vendor/autoload.php';
//LLAMAR LA DEPENDENCIA DE VLUCAS Y DECIRLE DONDE ESTA EL .ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); 
$dotenv->safeLoad(); //si no existe el archivo no marca error

require 'funciones.php';
require 'database.php';


// Conectarnos a la base de datos
use Model\ActiveRecord;

ActiveRecord::setDB($db);