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
      $patientId = $_SESSION['patient_id'];
      // var_dump($patient_id);
      // die();
      $patientProfessional_id = $Professional->associateProfessionalWithPatient($professionalId, $patientId);
      
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
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      // Recuperar los datos del formulario
      $name = $_POST['name'];
      $lastName = $_POST['lastname'];
      $licenseNumber = $_POST['license_number'];
      $specialtyId = $_POST['specialty'];
      $email = $_POST['email'];
      $phoneNumber = $_POST['phone_number'];

      if(!$name || !$lastName || !$licenseNumber || !$specialtyId || !$email || !$phoneNumber){
        echo "Faltan datos";
        die();
      }

      $professionalId = $_GET['id'];
      $Professional = new ProfessionalModel();
      $updatedProfessionalId = $Professional->update([
        'name' => $name,
        'lastName' => $lastName,
        'license_number' => $licenseNumber,
        'specialty_id' => $specialtyId,
        'email' => $email,
        'phone_number' => $phoneNumber,
      ], $professionalId);

      if(!$updatedProfessionalId){
        echo "Error al actualizar el profesional";
        die();
      }

      header('Location: /medicare/professional');
      die();
    }

    // Obtener el id del profesional a editar
    $id = $_GET['id'];

    // Obtener los datos del profesional
    $Professional = new ProfessionalModel();
    $professionalData = $Professional->getOne($id);

    // Obtener especialidades para popular el select
    $Specialty = new SpecialtyModel();
    $specialties = $Specialty->getAll();

    // Retornar el formulario de edicion
    return [
      'data' => [
        'professional' => $professionalData,
        'specialties' => $specialties
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
