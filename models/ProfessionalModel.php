<?php


class ProfessionalModel extends EntityModel
{
  public function getAll()
  {
    $resultados = $this->select('test');
    return 'data de la bd';
  }
}
