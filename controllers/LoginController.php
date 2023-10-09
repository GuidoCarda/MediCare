<?php 


class LoginController{
  
  // Mostrar formulario de login
  public static function list(){
    return [
      'data' => [],
      'view' => 'login/form'
    ];
  }

  // Iniciar sesión 
  public static function start(){
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    echo 'implementar validacion de datos';
    die($email . ' ' . $password);

    $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";

    $Patient = new PatientModel();

    $result = $Patient->select($query);

    if(count($result) == 0){
      return [
        'data' => [
          'message' => 'Usuario o contraseña incorrectos'
        ],
        'view' => 'login/form'
      ];
    }

    $_SESSION['id'] = $result[0]['id'];
    $_SESSION['name'] = $result[0]['name'];
    $_SESSION['email'] = $result[0]['email'];

    header('Location: /medicare/home');
  }


  //Cerrar sesión
  public static function end(){
    session_destroy();
    header('Location: /medicare/home');
  }
}