<?php



class ProfessionalController
{
  public static function list()
  {
    // tabla de resultados
    $Professional = new ProfessionalModel();
    $response = $Professional->getAll();
    
    return [
      'data' => $response,
      'view' => 'professionals/list',
    ];
  }

  public static function details()
  {
    // ver detalle de un profesional
    // obtener el id del profesional a mostrar
    $id = $_GET['id'];
    $Professional = new ProfessionalModel();
    $response = $Professional->getOne($id);
    return [
      'data' => ['professional' => $response],
      'view' => 'professionals/details',
    ];
  }

  public static function new()
  {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

      $name = $_POST['name'];
      $lastName = $_POST['lastname'];
      $licenseNumber = $_POST['license_number'];
      $specialtyId = $_POST['specialty'];
      $email = $_POST['email'];
      $phoneNumber = $_POST['phone_number'];

      // Valido que no haya campos vacios
      if(!$name || !$lastName || !$licenseNumber || !$specialtyId || !$email || !$phoneNumber){
        echo "Faltan datos";
        die();
      }

      // var_dump($name, $lastName, $licenseNumber, $specialtyId, $email, $phoneNumber);
      // die();


      $Professional = new ProfessionalModel(null, $name , $lastName , $licenseNumber ,  $specialtyId , $phoneNumber , $email );
      $professionalId = $Professional->create();
      $patient_id = $_SESSION['patient_id'];
      // var_dump($patient_id);
      // die();
      $patientProfessional_id = $Professional->associateProfessionalWithPatient($professionalId, $patient_id);
      
      if(!$professionalId || !$patientProfessional_id){
        echo "Error al crear el profesional";
        die();
      }
      header('Location: /medicare/professional');
    }

    // obtener especialidades para popular el select
    $Specialty = new SpecialtyModel();
    $specialties = $Specialty->getAll();

    // formulario de carga
    return [
      'data' => [
        'specialties' => $specialties
      ],
      'view' => 'professionals/new',
    ];
  }

  public static function edit()
  {
    $id = $_GET['id'];
    $Professional = new ProfessionalModel();
    $professionalData = $Professional->getOne($id);
    // Formulario de edicion
    // var_dump("actualizar profesional");
    return [
      'data' => [
        'professional' => $professionalData
      ],
      'view' => 'professionals/edit',
    ];
  }

  public static function delete()
  {
    // No renderizamos nada, borra y redirecciona
    var_dump("Eliminar profesional");
  }
}
