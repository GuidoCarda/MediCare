<?php


class ProfessionalRepository
{
  public static function getById($id)
  {
    // busca por id y retorna el registro si existe
    $query = '';
    $Profesional = new ProfessionalModel();
    $results = $Profesional->SELECT($query);
    return $results;
  }

  public static function getAll()
  {
    //retorna todos los profesionales.
  }

  public static function getBySpecialty($specialty_id)
  {
    //retorna los profesionales por especialidad.
  }
}
