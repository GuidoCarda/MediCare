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
    // TODO: Encriptar contraseña
    $password = $_POST['password'];
    // $password = sha1($_POST['password']);

    $user = UserModel::checkLogin($email, $password);
    // Obtener datos del paciente logueado, para guardarlos en la sesión

    if(!$user){
      return [
        'data' => [
          'message' => 'Usuario o contraseña incorrectos'
        ],
        'view' => 'login/form'
      ];
      die();
    }

    $Patient = new PatientModel();
    $userData = $Patient->getPatientByUserId($user['id']);

   

    $_SESSION['id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    // Id del paciente logueado
    $_SESSION['patient_id'] = $userData['id'];

    header('Location: /medicare/prescription');
  }


  //Cerrar sesión
  public static function end(){
    session_destroy();
    header('Location: /medicare/home');
  }
}