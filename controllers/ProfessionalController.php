<?php

namespace controllers;

class ProfessionalController
{
  public static function list()
  {
    // tabla de resultados
    // var_dump("Listar profesional");
    return [
      'data' => [],
      'view' => 'professionals/list',
    ];
  }

  public static function details()
  {
    // ver detalle
    // var_dump("detalles del profesional");
    return [
      'data' => [],
      'view' => 'professionals/details',
    ];
  }

  public static function new()
  {
    // formulario de carga
    // var_dump("alta de profesional");
    return [
      'data' => [],
      'view' => 'professionals/new',
    ];
  }

  public static function edit()
  {
    // Formulario de edicion
    // var_dump("actualizar profesional");
    return [
      'data' => [],
      'view' => 'professionals/edit',
    ];
  }

  public static function delete()
  {
    // No renderizamos nada, borra y redirecciona
    var_dump("Eliminar profesional");
  }
}
