
<?php 



class RegisterController {
  public static function list() {
    return [
      'data' => [],
      'view' => 'register/form'
    ];
  }

  public static function start() {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $password2 = sha1($_POST['password2']);

    if ($password != $password2) {
      return [
        'data' => [
          'message' => 'Las contraseñas no coinciden'
        ],
        'view' => 'register/form'
      ];
    }

    $query = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$password')";

    $Patient = new PatientModel();

    $result = $Patient->insert($query);

    if ($result == 0) {
      return [
        'data' => [
          'message' => 'Error al registrar el usuario'
        ],
        'view' => 'register/form'
      ];
    }

    header('Location: /medicare/login');
  }
}