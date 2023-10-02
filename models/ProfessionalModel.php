<?php


class ProfessionalModel extends EntityModel
{
  public function getAll()
  {
    $resultados = $this->select("SELECT * FROM blood_type");
    return 'data de la bd';
  }
}
