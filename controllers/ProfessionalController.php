<?php



class ProfessionalController
{
  public static function list()
  {
    //llamar al modelo
    // tabla de resultados
    // var_dump("Listar profesional");

    $profesional = new ProfessionalModel();
    $response = $profesional->getAll();
    // var_dump($response);
    // die();

    return [
      'data' => $response,
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
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      var_dump($_POST);
      die();
    }
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
