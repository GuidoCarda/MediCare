
<?php 

class RegisterController {
  public static function list() {

    // Obtengo todos los tipos de sangre de la base de datos
    $bloodTypes = new EntityModel('blood_type', 'bt');
    $bloodTypes = $bloodTypes->select();

    return [
      'data' => [
        'bloodTypes' => $bloodTypes
      ],
      'view' => 'register/form'
    ];

  }

  public static function start() {
    $bloodTypes = new EntityModel('blood_type', 'bt');
    $bloodTypes = $bloodTypes->select();

    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    // Chequeo si el usuario ya existe
    $exists = UserModel::getUserByEmail($email);

    // Si existe, devuelvo un mensaje de error
    if ($exists) {
      return [
        'data' => [
          'message' => 'El usuario ya existe',
          'bloodTypes' => $bloodTypes
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

    $patient = PatientModel::getPatientByDni($dni);
    
    // Si ya existe un usuario bajo ese dni, devuelvo un mensaje de error
    if(isset($patient['id'])){
      return [
        'data' => [
          'message' => 'Ya existe un usuario con ese DNI',
          'bloodTypes' => $bloodTypes
        ],
        'view' => 'register/form'
      ];
    }

    $user_id = UserModel::createUser($email, $password);

    // Si no se pudo crear el usuario, devuelvo un mensaje de error
    if ($user_id == 0) {
      return [
        'data' => [
          'message' => 'Error al registrar el usuario',
          'bloodTypes' => $bloodTypes
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