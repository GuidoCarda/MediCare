<?php

namespace controllers;

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
    return [
      'data' => [],
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
