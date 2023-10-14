<?php


class PrescriptionController
{
  public static function list()
  {
    // var_dump("Listar prescripcion");
    return [
      'data' => [],
      'view' => "prescriptions/list"
    ];
  }

  public static function details()
  {
    // var_dump("detalles del prescripcion");
    return [
      'data' => [],
      'view' => 'prescriptions/details'
    ];
  }

  public static function new()
  {
    // var_dump("alta de prescripcion");

    $Frequency = new EntityModel('frequency', 'f');
    $frequencies = $Frequency->select('*', 'f.id, f.denomination');

    $Professional = new ProfessionalModel();
    $professionals = $Professional->getAll();

    $MedicineType = new EntityModel('medicine_type', 'mt');
    $medicineTypes = $MedicineType->select('*', 'mt.id, mt.denomination, mt.unit');


    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $genericName = $_POST['generic_name'];
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
      $newPrescriptionId = $Prescription->create($quantity, $professionalId, $frequencyId, $medicineId);


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
    // var_dump("actualizar prescripcion");
    return [
      'data' => [],
      'view' => 'prescriptions/edit'
    ];
  }

  public static function delete()
  {
    // No renderizamos nada, borra y redirecciona
    var_dump("Eliminar prescripcion");
  }
}
