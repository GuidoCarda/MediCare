<?php

return function () {
  //Si no se recibe una categoria devuelve el valor despues de ??
  $category = $_GET['cat'] ?? 'home';
  $id = $_GET['id'] ?? NULL;
  $action = $_GET['a'] ?? 'list'; // Por defecto si no se recibe accion en la url se ejecuta la accion de listar

  // Genero la ruta al controllador que esta solicitandose por URL
  $controller = 'controllers\\' . $category . 'Controller';

  // var_dump($category, $id, $action);
  // echo "<br>";
  // var_dump($controller);

  //Si no existe el controlador devuelvo un error
  if (!class_exists($controller)) {
    return [
      'data' => [
        'error' => 'clase inexistente',
      ],
      'view' => 'error'
    ];
  }

  //Valido que el metodo solicitado exista.
  //Esto me permite identificar durante el desarrollo
  //si olvide implementar algun metodo de los validos,
  //ya que por como configure las urls, no acepta otro metodo
  //que no haya sido planificado
  if (!method_exists($controller, $action)) {
    return [
      'data' => [
        'error' => 'el metodo solicitado no existe'
      ],
      'view' => 'error'
    ];
  }

  //instancio el controller correspondiente a la peticion.
  // $clase = new $controller();
  //ejecuto el metodo correspondiente a la accion recibida como parametro
  // $clase->$action();

  //como los controllers no los necesito instanciar ya que basicamente 
  //me permiten redirreccionar segun las peticiones, puedo utilizar
  //los metodos estaticos en php que me permiten ejecutarlos directamente
  //sin necesidad de instanciar la clase.
  return $controller::$action();
};
