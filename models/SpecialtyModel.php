<?php 

class SpecialtyModel extends EntityModel{
  protected $table = 'specialty';
  protected $alias = 's';
  
  private $id;
  private $denomination;

  public function getAll(){
    return $this->select('id, denomination');
  }

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