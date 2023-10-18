<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
date_default_timezone_set("America/Argentina/Buenos_Aires");

session_start();

// define nos permite definir una constante en tiempo de ejecucion.
// Util para almacenar los pathnames de el filesystem,
// y acceder asi de forma sencilla a los diferentes direcctorios
// en nuestra app

// Path's / Direcciones de diferentes rutas en el sistema de ficheros para su simple acceso
define('ROOT', dirname(__DIR__));
define('VIEWS', ROOT . '/views');

// Configuracion Global de coneccion a bd con PDO
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'medicare');
