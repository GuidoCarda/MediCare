<?php
require 'utils/config.php';
require 'utils/autoload.php';
$routes = require 'utils/routes.php';

// $route = $_GET['cat'];

// if( !isset($_SESSION['id']) && $route != 'login' ){
//   //Si no hay id no esta logueado
//   header('Location: /medicare/login');
// }

$response = $routes();

if (!isset($response['view'])) {
  echo 'Routes no retorno la vista';
  die();
}

// Obtengo la ruta de la vista en el file system
$view = VIEWS . '/' . $response['view'] . '.html';
$data = $response['data'] ?? [];

// die($view);

// echo ($view);
include( VIEWS . '/layout/start.php' );
include( $view );
include( VIEWS . '/layout/finish.php' );


if (!file_exists($view)) {
  echo 'El archivo correspondiente a la ruta no existe o no esta en la direccion proporcionada';
  die();
}

