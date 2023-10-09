
<?php 



class RegisterController {
  public static function list() {

   $entity = new EntityModel();
   $bloodTypes = $entity->select('SELECT * FROM blood_type');
    

    return [
      'data' => [
        'bloodTypes' => $bloodTypes
      ],
      'view' => 'register/form'
    ];
  }

  public static function start() {
    $Patient = new PatientModel();
    $email = $_POST['email'];
    $password = $_POST['password'];

    $Patient->setTable('user');

    // var_dump($Patient->getTable());
    // die();
    $exists = $Patient->select("SELECT * FROM user WHERE email = '$email'");

    if (count($exists) > 0) {
      return [
        'data' => [
          'message' => 'El usuario ya existe'
        ],
        'view' => 'register/form'
      ];
    }

    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $blood_type_id = $_POST['bloodtype'];
    $dni = $_POST['dni'];
    $birthdate = $_POST['birthdate'];

    $userData = [
      'email' => $email,
      'password' => $password
    ];
    
    
    $user_id = $Patient->insert($userData); 
    
    // die($user_id);
    if ($user_id == 0) {
      return [
        'data' => [
          'message' => 'Error al registrar el usuario'
        ],
        'view' => 'register/form'
      ];
    }

    // die('llego aca');
    
    $Patient->setTable('patient');
    $patientData = [
      'user_id' => $user_id,
      'name' => $name,
      'lastname' => $lastname,
      'blood_type_id' => $blood_type_id,
      'dni' => $dni,
      'birth_date' => $birthdate
    ];

    $patient_id = $Patient->insert($patientData);

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