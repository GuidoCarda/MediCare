<?php


class ProfessionalModel extends EntityModel
{
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
}
