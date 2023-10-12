<?php

class PrescriptionModel extends EntityModel
{
  private $id;
  private $quantity;
  private $created_at;
  private $patient_id;
  private $professional_id;
  private $frequency_id;

  public function __construct($id = null, $quantity = null, $created_at = null, $patient_id = null, $professional_id = null, $frequency_id = null)
  {
    $this->id = $id;
    $this->quantity = $quantity;
    $this->created_at = $created_at;
    $this->patient_id = $patient_id;
    $this->professional_id = $professional_id;
    $this->frequency_id = $frequency_id;

    $this->table = 'prescription';
    $this->alias = 'p';
  }

  // Obtener todas las prescripciones para el paciente logueado
  public function getAll(){
    $patientId = $_SESSION['patient_id'];

    $results = $this->select(
      'p.id, p.quantity, p.created_at, pr.name, pr.lastName, f.denomination',
      [
        'joins'=>[
          'type' => 'inner', 'table' => 'professional pr', 'on' => 'p.professional_id = pr.id',
          'type' => 'inner', 'table' => 'frecuency f', 'on' => 'p.frecuency_id = f.id'
        ],
        'where'=> 'p.patient_id = :patientId',
        'replaces' => [':patientId' => $patientId],
        'order'=> 'p.created_at'
      ]
    );
    
    return $results;
  }
  
  // Obtener una prescripcion especifica por el id para el paciente logueado
  public function getOne($id){
    $patientId = $_SESSION['patient_id'];
    $results = $this->select('*',
      [
        'joins'=>[
          'type'=> 'inner', 'table'=> 'professional pr', 'on'=> 'p.professional_id = pr.id',
          'type'=> 'inner', 'table'=> 'frecuency f', 'on' => 'p.frecuency_id = f.id'
        ],
        'where' => 'p.id = :prescriptionId AND p.patient_id = :patientId',
        'replaces' => [':prescriptionId' => $id, ':patientId' => $patientId]
      ]
    );
    return $results;
  }

  // Crear una nueva prescripcion
  

}
