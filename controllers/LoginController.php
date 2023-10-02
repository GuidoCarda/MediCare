<?php

namespace controllers;

class LoginController{
  // Mostrar formulario de login 
  public static function list(){
    return [
      "view" => 'login/form'
    ];
  }

  // Iniciar sesion
  public function start(){
    $email = $_POST['email'];
    $password = sha1( $_POST['password'] );
    
    $query = "SELECT * FROM user WHERE id = $email AND password = $password";
   
  }

  // Cerrar sesion
  public function end(){
  }
}