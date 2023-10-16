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
      'p.id, p.quantity, p.created_at, p.medicine_id, pr.name, pr.lastName, f.denomination as frequency, m.drug, m.generic_name, mt.denomination as medicine_type, mt.unit as medicine_unit',
      [
        'joins'=>[
          ['type' => 'inner', 'table' => 'professional pr', 'on' => 'p.professional_id = pr.id'],
          ['type' => 'inner', 'table' => 'frequency f', 'on' => 'p.frequency_id = f.id'],
          ['type' => 'inner', 'table' => 'medicine m', 'on' => 'p.medicine_id = m.id'],
          ['type' => 'inner', 'table' => 'medicine_type mt', 'on' => 'm.medicine_type_id = mt.id']
        ],
        'where'=> 'p.patient_id = :patientId',
        'replaces' => [':patientId' => $this->patientId],
        'order'=> 'p.created_at DESC'
      ]
    );
    
    return $results;
  }
  
  public function getLatestPerMedicine(){
    $results = $this->select(
      'p.id, p.quantity, p.created_at, p.medicine_id, pr.name, pr.lastName, f.denomination as frequency, m.drug, m.generic_name, mt.denomination as medicine_type, mt.unit as medicine_unit',
      [
        'joins'=>[
          ['type' => 'inner', 'table' => 'professional pr', 'on' => 'p.professional_id = pr.id'],
          ['type' => 'inner', 'table' => 'frequency f', 'on' => 'p.frequency_id = f.id'],
          ['type' => 'inner', 'table' => 'medicine m', 'on' => 'p.medicine_id = m.id'],
          ['type' => 'inner', 'table' => 'medicine_type mt', 'on' => 'm.medicine_type_id = mt.id']
        ],
        'where'=> 'p.patient_id = :patientId AND p.is_active = 1 AND p.id IN (SELECT MAX(p2.id) FROM prescription p2 GROUP BY p2.medicine_id)',
        'replaces' => [':patientId' => $this->patientId],
      ]
    );
    
    return $results;
  }
  

  // Obtener una prescripcion especifica por el id para el paciente logueado
  public function getOne($id){
    $results = $this->select('p.quantity, p.created_at, p.professional_id ,p.frequency_id , pr.name, pr.lastName, s.denomination as specialty, f.denomination as frequency, m.drug, m.generic_name, mt.denomination as medicine_type, mt.unit as medicine_unit',
      [
        'joins'=>[
          ['type'=> 'inner', 'table'=> 'professional pr', 'on'=> 'p.professional_id = pr.id'],
          ['type'=> 'inner', 'table'=> 'specialty s', 'on' => 'pr.specialty_id = s.id'],
          ['type'=> 'inner', 'table'=> 'frequency f', 'on' => 'p.frequency_id = f.id'],
          ['type'=> 'inner', 'table'=> 'medicine m', 'on' => 'p.medicine_id = m.id'],
          ['type'=> 'inner', 'table'=> 'medicine_type mt', 'on' => 'm.medicine_type_id = mt.id']
        ],
        'where' => 'p.id = :prescriptionId AND p.patient_id = :patientId',
        'replaces' => [':prescriptionId' => $id, ':patientId' => $this->patientId]
      ],
      true
    );
    return $results;
  }

  // Obtener el historial de una prescripcion especifica por el id para el paciente logueado
  public function getHistory($genericName, $drug){
    $results = $this->select('p.created_at, p.quantity, f.denomination as frequency, mt.unit as medicine_unit',
      [
        'joins'=>[
          ['type'=> 'inner', 'table'=> 'frequency f', 'on' => 'p.frequency_id = f.id'],
          ['type'=> 'inner', 'table'=> 'medicine m', 'on' => 'p.medicine_id = m.id'],
          ['type'=> 'inner', 'table'=> 'medicine_type mt', 'on'=>' m.medicine_type_id = mt.id']
        ],
        'where' => 'p.patient_id = :patientId AND m.generic_name = :genericName AND m.drug = :drug',
        'replaces' => [':patientId' => $this->patientId ,':genericName' => $genericName, ':drug' => $drug ],
        'order'=>'p.created_at DESC'
      ]
      ,
    );
    return $results;
  }

  // Crear una nueva prescripcion
  public function create($quantity, $createdAt, $professionalId, $frequencyId, $medicineId){
    // var_dump($quantity,$createdAt, $professionalId, $frequencyId, $medicineId);
    // die();
    $newPrescriptionId = $this->insert(
      [
        'quantity' => $quantity,
        'created_at' => $createdAt,
        'patient_id' => $this->patientId,
        'professional_id' => $professionalId,
        'frequency_id' => $frequencyId,
        'medicine_id' => $medicineId
      ]
    );

    return $newPrescriptionId;
  }


  public function findExistingPrescription($medicineId){
    $result = $this->select(
      'p.id, p.is_active',
      [
        'where' => 'p.patient_id = :patientId AND p.medicine_id = :medicineId',
        'replaces' => [':patientId' => $this->patientId, ':medicineId' => $medicineId],
        'order' => 'p.created_at DESC'
      ],
      true
    );

    return $result;
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
