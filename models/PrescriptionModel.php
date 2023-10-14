<?php

class PrescriptionModel extends EntityModel
{
  protected $table = 'prescription';
  protected $alias = 'p';

  private $patientId;

  public function __construct($patientId = null)
  {
    $this->patientId = $_SESSION['patient_id'] ?? $patientId;
  }

  // Obtener todas las prescripciones para el paciente logueado
  public function getAll(){

    $results = $this->select(
      'p.id, p.quantity, p.created_at, pr.name, pr.lastName, f.denomination',
      [
        'joins'=>[
          'type' => 'inner', 'table' => 'professional pr', 'on' => 'p.professional_id = pr.id',
          'type' => 'inner', 'table' => 'frecuency f', 'on' => 'p.frecuency_id = f.id'
        ],
        'where'=> 'p.patient_id = :patientId',
        'replaces' => [':patientId' => $this->patientId],
        'order'=> 'p.created_at'
      ]
    );
    
    return $results;
  }
  
  // Obtener una prescripcion especifica por el id para el paciente logueado
  public function getOne($id){
    $results = $this->select('*',
      [
        'joins'=>[
          'type'=> 'inner', 'table'=> 'professional pr', 'on'=> 'p.professional_id = pr.id',
          'type'=> 'inner', 'table'=> 'frecuency f', 'on' => 'p.frecuency_id = f.id'
        ],
        'where' => 'p.id = :prescriptionId AND p.patient_id = :patientId',
        'replaces' => [':prescriptionId' => $id, ':patientId' => $this->patientId]
      ]
    );
    return $results;
  }

  // Crear una nueva prescripcion
  public function create($quantity, $professionalId, $frequencyId, $medicineId){
    // var_dump($quantity, $professionalId, $frequencyId, $medicineId);
    // die();
    $newPrescriptionId = $this->insert(
      [
        'quantity' => $quantity,
        'created_at' => date('Y-m-d'),
        'patient_id' => $this->patientId,
        'professional_id' => $professionalId,
        'frequency_id' => $frequencyId,
        'medicine_id' => $medicineId
      ]
    );

    return $newPrescriptionId;
  }


  public function medicineExists($genericName, $drug){
    $Medicine = new EntityModel('medicine', 'm');
    $result = $Medicine->select(
      '*', 
      [
        'where' => 'm.generic_name = :genericName AND m.drug = :drug',
        'replaces' => [':genericName' => $genericName, ':drug' => $drug]
      ]
      , true
    );

    return $result;
  }

  public function createMedicine($medicine){
    $Medicine = new EntityModel('medicine', 'm');
    $medicineId = $Medicine->insert($medicine);
  }

}
