<?php
require 'utils/config.php';
require 'utils/autoload.php';
$routes = require 'utils/routes.php';

$respuesta = $routes();

if (!isset($respuesta['view'])) {
  echo 'Routes no retorno la vista';
  die();
}

// Obtengo la ruta de la vista en el file system
$view = VIEWS . '/' . $respuesta['view'] . '.html';

// echo ($view);
include(VIEWS . '/layout/start.php');
include($view);
include(VIEWS . '/layout/finish.php');


if (!file_exists($view)) {
  echo 'El archivo correspondiente a la ruta no existe o no esta en la direccion proporcionada';
  die();
}

// logear lo que devuelve $routes();
// var_dump($respuesta);
