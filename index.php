<?php
require 'utils/config.php';
$routes = require 'utils/routes.php';

require 'controllers/ProfessionalController.php';
require 'controllers/PrescriptionController.php';

// use controllers\ProfessionalController;
// use controllers\PrescriptionController;

$respuesta = $routes();

if (!isset($respuesta['view'])) {
  echo 'Routes no retorno la vista';
  die();
}

// Obtengo la ruta de la vista en el file system
$view = VIEWS . '/' . $respuesta['view'] . '.html';

// echo ($view);
include $view;

if (!file_exists($view)) {
  echo 'El archivo correspondiente a la ruta no existe o no esta en la direccion proporcionada';
  die();
}

// logear lo que devuelve $routes();
// var_dump($respuesta);
