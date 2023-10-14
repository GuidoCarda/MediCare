<?php


class ProfessionalModel extends EntityModel
{
  private $id;
  private $name;
  private $lastname;
  private $license_number;
  private $phone_number;
  private $specialty_id;
  private $email;

  public function __construct($id = null, $name = null, $lastname = null, $license_number = null,$specialty_id = null, $phone_number = null, $email = null)
  {
    $this->id = $id;
    $this->name = $name;
    $this->lastname = $lastname;
    $this->license_number = $license_number;
    $this->specialty_id = $specialty_id;
    $this->phone_number = $phone_number;
    $this->email = $email;

    $this->table = 'professional';
    $this->alias = 'p';
  }
  
  // Retorna todos los profesionales asociados a un paciente
  public function getAll()
  {
    $patient_id = $_SESSION['patient_id']; 
    $results = $this->select('p.id ,p.name, p.lastName, p.phone_number, p.email, pp.status, s.denomination AS specialty', 
      [
      'joins' => [
        [
          'type' => 'inner',
          'table' => 'patient_professional pp', 'on' => 'p.id = pp.professional_id'
        ],
        [
          'type' => 'inner',
          'table' => 'specialty s', 'on' => 'p.specialty_id = s.id' 
        ]
      ],
        'where' => 'pp.patient_id = ' . $patient_id,
    ] );

    return $results;
  }

  // Retorna los datos de un profesional por id
  public function getOne($id)
  {
    $results = $this->select(
      'p.id, p.name, p.lastName, p.phone_number, p.license_number, p.email, p.specialty_id, s.denomination AS specialty',
      [
        'joins' => [
          [
            'type' => 'inner',
            'table' => 'specialty s', 'on' => 'p.specialty_id = s.id'
          ]
        ],
        'where' => 'p.id = ' . $id,
      ],
      true
    );
    return $results;
  }

  //Chekea si existe un profesional con el mismo numero de matricula
  public function exists($license_number)
  {
    $results = $this->select(
      'p.id',
      [
        'where' => "p.license_number = '$license_number'",
      ],
      true
    );
    return $results;
  }

  // Crea un profesional
  public function create(){
    // var_dump($this->name);
    // var_dump($this->lastname);
    // var_dump($this->license_number);
    // var_dump($this->phone_number);
    // var_dump($this->specialty_id);
    $exists = $this->exists($this->license_number);
    // Si existe, no lo creo y hago la relacion 
    if($exists){
      // Si ya existe un profecional con esa matricula, retorno el id para hacer la relacion      
      return $exists['id'];
    }

    // die();
    $insertId = $this->insert([
      'name' => $this->name,
      'lastName' => $this->lastname,
      'license_number' => $this->license_number,
      'phone_number' => $this->phone_number,
      'specialty_id' => $this->specialty_id,
      'email' => $this->email,
    ]);

    $this->id = $insertId;
    return $insertId;
  }

  // Relaciona un profesional con un paciente que lo cree / seleccione
  public function associateProfessionalWithPatient($professional_id, $patient_id){
    $PatientProfessional = new EntityModel('patient_professional', 'pp');
    // $PatientProfessional->table = 'patient_professional';
    // $PatientProfessional->alias = 'pp';
    $patientProfessional_id = $PatientProfessional->insert([
      'patient_id' => $patient_id,
      'professional_id' => $professional_id,
    ]);

    return $patientProfessional_id;
  }

}
