<?php


class ProfessionalModel extends EntityModel
{
  private $id;
  private $name;
  private $lastname;
  private $license_number;
  private $phone_number;
  private $specialty_id;
  private $email;

  public function __construct($id = null, $name = null, $lastname = null, $license_number = null, $phone_number = null, $specialty_id = null, $email = null)
  {
    $this->id = $id;
    $this->name = $name;
    $this->lastname = $lastname;
    $this->license_number = $license_number;
    $this->phone_number = $phone_number;
    $this->specialty_id = $specialty_id;
    $this->email = $email;

    $this->table = 'professional';
    $this->alias = 'p';
  }
  
  public function getAll()
  {
    $query = "SELECT p.name, 
                     p.lastName, 
                     p.phone_number, 
                     s.denomination 
              FROM professional p 
              INNER JOIN specialty s ON p.specialty_id = s.id";
    $resultados = $this->select($query);
    return $resultados;
  }

  public function getOne($id)
  {
    $query = "SELECT p.name, 
                     p.lastName, 
                     p.phone_number, 
                     s.denomination 
              FROM professional p 
              INNER JOIN specialty s ON p.specialty_id = s.id
              WHERE p.id = $id";
    $resultados = $this->select($query);
    return $resultados;
  }

  
}
