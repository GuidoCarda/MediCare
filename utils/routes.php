<?php

return function () {
  //Si no se recibe una categoria devuelve el valor despues de ??
  $category = $_GET['cat'] ?? 'home';
  $id = $_GET['id'] ?? NULL;
  $action = $_GET['a'] ?? 'list';

  var_dump("\ncategoria: $category \nid: $id \naccion: $action");
};
