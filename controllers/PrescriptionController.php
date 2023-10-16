<?php


class PrescriptionController
{
  public static function list()
  {

    $Prescription = new PrescriptionModel();
    // $prescriptions = $Prescription->getAll();
    $prescriptions = $Prescription->getLatestPerMedicine();

    // var_dump($prescriptions);
    // die();

    return [
      'data' => [
        'prescriptions'=> $prescriptions
      ],
      'view' => "prescriptions/list"
    ];
  }

  public static function details()
  {
    $prescriptionId = $_GET['id'];

    $Prescription = new PrescriptionModel();
    $prescriptionDetail = $Prescription->getOne($prescriptionId);

    $genericName = $prescriptionDetail['generic_name'];
    $drug = $prescriptionDetail['drug'];

    $prescriptionHistory = $Prescription->getHistory($genericName, $drug);
   

    return [
      'data' => [
        'prescriptionDetail'=> $prescriptionDetail,
        'prescriptionHistory' => $prescriptionHistory
      ],
      'view' => 'prescriptions/details'
    ];
  }

  public static function new()
  {
    $Frequency = new EntityModel('frequency', 'f');
    $frequencies = $Frequency->select('*', 'f.id, f.denomination');

    $Professional = new ProfessionalModel();
    $professionals = $Professional->getAll();

    $MedicineType = new EntityModel('medicine_type', 'mt');
    $medicineTypes = $MedicineType->select('*', 'mt.id, mt.denomination, mt.unit');


    if(isPost()) {
      $genericName = $_POST['generic_name'];
      $createdAt = $_POST['created_at'] === '' ? date('Y-m-d') : $_POST['created_at'];
      $drug = $_POST['drug'];
      $medicineTypeId = $_POST['medicine_type'];
      $quantity = $_POST['quantity'];
      $frequencyId = $_POST['frequency_id'];
      $professionalId = $_POST['professional_id'];

      // validar que los campos no esten vacios
      if(empty($genericName) || empty($drug) || empty($medicineTypeId) || empty($quantity) || empty($frequencyId) || empty($professionalId)) {
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

      $Medicine = new MedicineModel();
      $medicineExists = $Medicine->exists($genericName, $drug);

      if(isset($medicineExists['id'])){
        $medicineId = $medicineExists['id'];
      }else{
        $medicineId = $Medicine->create($genericName, $drug, $medicineTypeId);
      }

      $Prescription = new PrescriptionModel();
      $newPrescriptionId = $Prescription->create($quantity, $createdAt, $professionalId, $frequencyId, $medicineId);

      if($newPrescriptionId === 0){
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

    $Professional = new ProfessionalModel();
    $professionals = $Professional->getAll();

    $MedicineType = new EntityModel('medicine_type', 'mt');
    $medicineTypes = $MedicineType->select('*', 'mt.id, mt.denomination, mt.unit');

    $Prescription = new PrescriptionModel();
    $prescription = $Prescription->getOne($prescriptionId);

    if(isPost()){
      $quantity = $_POST['quantity'];
      $createdAt = $_POST['created_at']; 
      $professionalId = $prescription['professional_id'];
      $frecuencyId = $_POST['frequency_id'];
      $medicineId = $prescription['medicine_id'];

      $newPrescriptionId = $Prescription->create($quantity, $createdAt, $professionalId,$frecuencyId, $medicineId);

      if($newPrescriptionId === 0){
        echo 'Algo salio mal al actualizar la prescripcion';
        die();
      }

      header('Location: /medicare/prescription');
      die();
    }

    return [
      'data' => [
        'prescription'=> $prescription,
        'medicineTypes' => $medicineTypes,
        'frequencies' => $frequencies,
        'professionals' => $professionals
      ],
      'view' => 'prescriptions/edit'
    ];
  }

  public static function delete()
  {
    $medicineId = $_GET['id'];

    $Prescription = new PrescriptionModel();
    $affectedRow = $Prescription->update([
      'is_active' => 0,
      'created_at' => date('Y-m-d'),
    ], $medicineId);
   
    if(!$affectedRow){
      echo "Error al suspender la prescripcion";
      die();
    }

    header('Location: /medicare/prescription');
  }
}
