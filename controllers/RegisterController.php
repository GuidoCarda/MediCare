
<?php 

class RegisterController {
  public static function list() {

    $Entity = new EntityModel();
    $Entity->setTable('blood_type');
    $bloodTypes = $Entity->select();

    return [
      'data' => [
        'bloodTypes' => $bloodTypes
      ],
      'view' => 'register/form'
    ];

  }

  public static function start() {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Chequeo si el usuario ya existe
    $exists = UserModel::getUserByEmail($email);

    // Si existe, devuelvo un mensaje de error
    if ($exists) {
      return [
        'data' => [
          'message' => 'El usuario ya existe'
        ],
        'view' => 'register/form'
      ];

      die();      
    }
    // Si no existe, lo creo
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $blood_type_id = $_POST['bloodtype'];
    $dni = $_POST['dni'];
    $birthdate = $_POST['birthdate'];

    $user_id = UserModel::createUser($email, $password);

    // var_dump($user_id);
    // die();
    // Si no se pudo crear el usuario, devuelvo un mensaje de error
    if ($user_id == 0) {
      return [
        'data' => [
          'message' => 'Error al registrar el usuario'
        ],
        'view' => 'register/form'
      ];
    }

    $patientData = [
      'user_id' => $user_id,
      'name' => $name,
      'lastname' => $lastname,
      'blood_type_id' => $blood_type_id,
      'dni' => $dni,
      'birth_date' => $birthdate
    ];

    $patient_id = PatientModel::createPatient($patientData);

    if($patient_id == 0) {
      return [
        'data' => [
          'message' => 'Error al registrar el paciente'
        ],
        'view' => 'register/form'
      ];
    }

    header('Location: /medicare/login');
  }
}