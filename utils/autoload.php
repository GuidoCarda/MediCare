<!-- 
  Este archivo me permite autoimprotar las diferentes clases de mi aplicacion, permitiendo esto, agilizar el desarrollo. Evitando asi errores por falta de importaciones o errores de los nombres. Ademas facilita el incremento progresivo del proyecto  
-->
<?php
//glob devuelve un arreglo con aquellos directorios/archivos que coinciden con el string que recibe como parametro.
$controllers = glob(ROOT . '/controllers/*.php');
$models = glob(ROOT . '/models/*.php');
foreach ($controllers as $c) require $c;
foreach ($models as $m) require $m;
?>