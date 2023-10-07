<!-- 
  Este archivo me permite autoimprotar las diferentes clases de mi aplicacion, permitiendo esto, agilizar el desarrollo. Evitando asi errores por falta de importaciones o errores de los nombres. Ademas facilita el incremento progresivo del proyecto  
-->
<?php
//glob devuelve un arreglo con aquellos directorios/archivos que coinciden con el string que recibe como parametro.
$controllers = glob(ROOT . '/controllers/*.php');
$models = glob(ROOT . '/models/*.php');
//Debido a que se requiere alfabeticamente, el archivo EntityModel.php, se debe requerir antes de los demas modelos para evitar errores de dependencias entre clases
require ROOT . '/models/EntityModel.php';

foreach ($controllers as $c) require_once $c;
foreach ($models as $m) require_once $m;
?>