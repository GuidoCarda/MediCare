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

  public function getAll(){

    $patientId = $_SESSION['id'];
    $query = "SELECT p.id, 
                     p.quantity, 
                     p.created_at, 
                     pr.name, 
                     pr.lastName, 
                     f.denomination 
              FROM prescription p 
              INNER JOIN professional pr ON p.professional_id = pr.id 
              INNER JOIN frequency f ON p.frequency_id = f.id
              WHERE p.patient_id = $patientId";
    $resultados = $this->select($query);
    return $resultados;
  }
  

  public function getOne($id){
    $query = "SELECT p.id, 
                     p.quantity, 
                     p.created_at, 
                     pr.name, 
                     pr.lastName, 
                     f.denomination 
              FROM prescription p 
              INNER JOIN professional pr ON p.professional_id = pr.id 
              INNER JOIN frequency f ON p.frequency_id = f.id
              WHERE p.id = $id";
    $resultados = $this->select($query);
    return $resultados;
  }
}
