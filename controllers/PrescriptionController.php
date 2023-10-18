<?php


class PrescriptionController
{
  public static function list()
  {
    $Prescription = new PrescriptionModel();
    // $prescriptions = $Prescription->getAll(); // Lista todas las prescripciones
    $prescriptions = $Prescription->getLatestPerMedicine();

    return [
      'data' => [
        'prescriptions' => $prescriptions
      ],
      'view' => "prescriptions/list"
    ];
  }

  public static function details()
  {
    // Obtengo el id de la prescripcion a mostrar
    $prescriptionId = $_GET['id'];

    // Obtengo el detalle de la prescripcion
    $Prescription = new PrescriptionModel();
    $prescriptionDetail = $Prescription->getPrescriptionDetail($prescriptionId);

    if (!$prescriptionDetail) {
      return [
        'data' => [],
        'view' => 'prescriptions/details'
      ];
    }

    // Extraigo el nombre generico y la droga para buscar el historial de prescripciones
    $genericName = $prescriptionDetail['generic_name'];
    $drug = $prescriptionDetail['drug'];

    // Obtengo el historial de prescripciones para esta medicacion
    $prescriptionHistory = $Prescription->getHistory($genericName, $drug);

    return [
      'data' => [
        'prescriptionDetail' => $prescriptionDetail,
        'prescriptionHistory' => $prescriptionHistory
      ],
      'view' => 'prescriptions/details'
    ];
  }

  public static function new()
  {
    $Frequency = new EntityModel('frequency', 'f');
    $frequencies = $Frequency->select('*', 'f.id, f.denomination');

    $MedicineType = new EntityModel('medicine_type', 'mt');
    $medicineTypes = $MedicineType->select('*', 'mt.id, mt.denomination, mt.unit');

    $Professional = new ProfessionalModel();
    $professionals = $Professional->getAll();

    if (isPost()) {
      $genericName = $_POST['generic_name'];
      $createdAt = $_POST['created_at'] === '' ? date('Y-m-d') : $_POST['created_at'];
      $drug = $_POST['drug'];
      $medicineTypeId = $_POST['medicine_type'];
      $quantity = $_POST['quantity'];
      $frequencyId = $_POST['frequency_id'];
      $professionalId = $_POST['professional_id'];

      // validar que los campos no esten vacios
      if (empty($genericName) || empty($drug) || empty($medicineTypeId) || empty($quantity) || empty($frequencyId) || empty($professionalId)) {
        return [
          'data' => [
            'message' => 'Debe completar todos los campos',
            'medicineTypes' => $medicineTypes,
            'frequencies' => $frequencies,
            'professionals' => $professionals
          ],
          'view' => 'prescriptions/new'
        ];
      }

      // Verifico si la medicina ya existe
      $Medicine = new MedicineModel();
      $medicineExists = $Medicine->exists($genericName, $drug);

      //Si existe, obtengo el id, sino creo una nueva medicina
      if (isset($medicineExists['id'])) {
        $medicineId = $medicineExists['id'];
      } else {
        $medicineId = $Medicine->create($genericName, $drug, $medicineTypeId);
      }

      $Prescription = new PrescriptionModel();
      $prescriptionData = [
        'quantity' => $quantity,
        'created_at' => $createdAt,
        'professional_id' => $professionalId,
        'frequency_id' => $frequencyId,
        'medicine_id' => $medicineId,
      ];

      // Creo una nueva prescripcion para el paciente logueado
      $newPrescriptionId = $Prescription->create($prescriptionData);

      if ($newPrescriptionId === 0) {
        echo 'Algo salio mal al crear la prescripcion';
        die();
      }

      header('Location: /medicare/prescription');
    }


    return [
      'data' => [
        'medicineTypes' => $medicineTypes,
        'frequencies' => $frequencies,
        'professionals' => $professionals
      ],
      'view' => 'prescriptions/new'
    ];
  }

  public static function edit()
  {
    $prescriptionId = $_GET['id'];

    $Frequency = new EntityModel('frequency', 'f');
    $frequencies = $Frequency->select('*', 'f.id, f.denomination');

    $MedicineType = new EntityModel('medicine_type', 'mt');
    $medicineTypes = $MedicineType->select('*', 'mt.id, mt.denomination, mt.unit');

    $Professional = new ProfessionalModel();
    $professionals = $Professional->getAll();


    // Obtengo el detalle de la prescripcion a editar
    $Prescription = new PrescriptionModel();
    $prescription = $Prescription->getPrescriptionDetail($prescriptionId);

    if (isPost()) {
      $quantity = $_POST['quantity'];
      $createdAt = $_POST['created_at'];
      $professionalId = $_POST['professional_id'];
      $frecuencyId = $_POST['frequency_id'];
      $medicineId = $prescription['medicine_id'];

      $prescriptionData = [
        'quantity' => $quantity,
        'created_at' => $createdAt,
        'professional_id' => $professionalId,
        'frequency_id' => $frecuencyId,
        'medicine_id' => $medicineId,
      ];

      $newPrescriptionId = $Prescription->create($prescriptionData);

      if ($newPrescriptionId === 0) {
        echo 'Algo salio mal al actualizar la prescripcion';
        die();
      }

      header('Location: /medicare/prescription');
      die();
    }

    return [
      'data' => [
        'prescription' => $prescription,
        'medicineTypes' => $medicineTypes,
        'frequencies' => $frequencies,
        'professionals' => $professionals
      ],
      'view' => 'prescriptions/edit'
    ];
  }

  public static function delete()
  {
    $prescriptionId = $_GET['id'];

    $Prescription = new PrescriptionModel();
    $response = $Prescription->getById($prescriptionId);

    $prescriptionData = [
      'quantity' => $response['quantity'],
      'created_at' => $response['created_at'],
      'professional_id' => $response['professional_id'],
      'frequency_id' => $response['frequency_id'],
      'medicine_id' => $response['medicine_id'],
      'is_active' => 0
    ];

    //Creo un nuevo registro en el que se suspende la prescripcion,
    //No actualizo el ultimo ya que deseo mantener el historial de prescripciones
    $suspendedPrescriptionId = $Prescription->create($prescriptionData);

    header('Location: /medicare/prescription');
  }
}
