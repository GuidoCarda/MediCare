<?php 

class PatientModel extends EntityModel{

  protected $table;
  protected $alias;

  private $id;
  private $name;
  private $lastname;
  private $birthdate;
  private $user_id;
  private $blood_type_id;

  public function __construct($id = null, $name = null, $lastname = null, $birthdate = null, $user_id = null, $blood_type_id = null)
  {
    $this->id = $id;
    $this->name = $name;
    $this->lastname = $lastname;
    $this->birthdate = $birthdate;
    $this->user_id = $user_id;
    $this->blood_type_id = $blood_type_id;

    $this->table = 'patient';
    $this->alias = 'p';
  }


  public static function createPatient($patientData){
    $Patient = new PatientModel();
    $patient_id = $Patient->insert($patientData);
    return $patient_id;
  }

  public static function getPatientByDni($dni){
    $Patient = new PatientModel();
    $result = $Patient->select(
      '*',
      [
        'where' => "dni = :dni",
        'replaces' => [':dni' => $dni]
      ],
      true
    );
    return $result;
  }

  public function getPatientByUserId($user_id){
    $Patient = new PatientModel();
    $result = $Patient->select(
      '*',
      [
        'where' => "user_id = :id",
        'replaces' => [':id' => $user_id]
      ],
      true
    );
    return $result;
  }
  
} 


?>