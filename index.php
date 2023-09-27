<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
var_dump($_GET);

$routes = require 'utils/routes.php';

require 'controllers/ProfessionalController.php';
require 'controllers/PrescriptionController.php';

// use controllers\ProfessionalController;
// use controllers\PrescriptionController;

$respuesta = $routes();

var_dump($respuesta);
