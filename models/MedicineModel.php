<?php

class MedicineModel extends EntityModel{
  protected $table = 'medicine';
  protected $alias = 'm';

  // Crear una medicina
  public function create($genericName, $drug, $medicineTypeId){
    $newMedicineId = $this->insert(
      [
        'generic_name' => $genericName,
        'drug' => $drug,
        'medicine_type_id' => $medicineTypeId
      ]
    );

    return $newMedicineId;
  }

  // Consulto si existe una medicina
  public function exists($genericName, $drug){
    $result = $this->select(
      '*',
      [
        'where' => 'generic_name = :genericName AND drug = :drug',
        'replaces' => [':genericName' => $genericName, ':drug' => $drug]
      ],
      true
    );
    return $result;
  }

  // Obtener los datos de una medicina por id
  public function getOne($id){
    $result = $this->select(
      '*',
      [
        'where' => 'id = :id',
        'replaces' => [':id' => $id]
      ],
      true
    );
    return $result;
  }



}