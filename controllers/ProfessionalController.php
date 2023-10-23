<?php



class ProfessionalController
{
  public static function list()
  {
    // Obtengo los datos de todos los profesionales que atienden al paciente logueado
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

    // obtener los datos del profesional
    $Professional = new ProfessionalModel();
    $response = $Professional->getOne($id);

    $data = [];

    if ($response) {
      $data = ['professional' => $response];
    }

    return [
      'data' => $data,
      'view' => 'professionals/details',
    ];
  }

  public static function new()
  {
    if (isPost()) {
      // Recupero los datos del formulario
      $name = $_POST['name'];
      $lastName = $_POST['lastname'];
      $licenseNumber = $_POST['license_number'];
      $specialtyId = $_POST['specialty'];
      $email = $_POST['email'];
      $phoneNumber = $_POST['phone_number'];

      // Valido que no haya campos vacios
      if (!$name || !$lastName || !$licenseNumber || !$specialtyId || !$email || !$phoneNumber) {
        echo "Faltan datos";
        die();
      }

      $Professional = new ProfessionalModel(null, $name, $lastName, $licenseNumber,  $specialtyId, $phoneNumber, $email);

      //Crea el profesional, si ya existe retorna el id del profesional existente
      $professionalId = $Professional->create();
      $patientId = $_SESSION['patient_id'];

      //Asocia el profesional con el paciente
      $patientProfessional_id = $Professional->associateProfessionalWithPatient($professionalId, $patientId);

      if (!$professionalId || !$patientProfessional_id) {
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
    // Obtener el id del profesional a editar
    $professionalId = $_GET['id'];

    // Si el metodo es POST, actualizar el profesional, solo los datos de contacto
    if (isPost()) {
      // Recuperar los datos del formulario
      $email = $_POST['email'];
      $phoneNumber = $_POST['phone_number'];

      // Validar que no haya campos vacios
      if (!$email || !$phoneNumber) {
        echo "Faltan datos";
        die();
      }

      // Actualizar el profesional
      $Professional = new ProfessionalModel();
      $affectedRow = $Professional->update([
        'email' => $email,
        'phone_number' => $phoneNumber,
      ], $professionalId);

      // Redireccionar a la lista de profesionales
      header('Location: /medicare/professional');
      die();
    }

    // Obtener los datos del profesional
    $Professional = new ProfessionalModel();
    $professionalData = $Professional->getOne($professionalId);

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
    // Obtener el id del profesional a eliminar
    $professionalId = $_GET['id'];
    // Actualizar estado profecional a inactivo
    $Professional = new ProfessionalModel();
    $Professional->update([
      'status' => 0,
    ], $professionalId);
    // Redireccionar a la lista de profesionales
    header('Location: /medicare/professional');
  }
}
