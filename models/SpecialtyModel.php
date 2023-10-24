<?php 

class SpecialtyModel extends EntityModel{
  protected $table = 'specialty';
  protected $alias = 's';
  
  private $id;
  private $denomination;

  // Obtener todas las especialidades
  public function getAll(){
    return $this->select('id, denomination');
  }

  // Obtener una especialidad por su id
  public function getById($id){
    return $this->select(
      'id, denomination',
      [
        'where'=> 'id = :id', 
        'replaces' => [':id' => $id]
      ], 
      true
    );
  }
}