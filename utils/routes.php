<?php

return function () {
  //Si no se recibe una categoria devuelve el valor despues de ??
  $category = $_GET['cat'] ?? 'home';
  $id = $_GET['id'] ?? NULL;
  $action = $_GET['a'] ?? 'list'; // Por defecto si no se recibe accion en la url se ejecuta la accion de listar

  // var_dump($category);
  // echo '<br>';
  // var_dump($id);
  // echo '<br>';
  // var_dump($action);
  // die();

  //Defino las rutas publicas
  $publicRoutes = Array('home','contact','login','register','error');

  // Si no esta logueado y la ruta no es publica, redirrecciono al login
  if (!in_array($category, $publicRoutes) && !isset($_SESSION['id'])  ) {
    //Si no hay id no esta logueado
    header('Location: /medicare/login');
  }

  // Si esta logueado  y la ruta es login o registro, redirrecciono a prescripciones
  if(isset($_SESSION['id'])){
    if (in_array($category, ['home','login','register'])) {
      header('Location: /medicare/prescription');
    }
  }

  // Genero la ruta al controllador que esta solicitandose por URL
  $controller =  $category . 'Controller';

  //Si no existe el controlador devuelvo un error
  if (!class_exists($controller)) {
    return [
      'data' => [
        'message' => "clase $controller inexistente",
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
        'message' => "el metodo $action solicitado no existe en la clase $controller"
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
