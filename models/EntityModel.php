<!-- 
  EntityModel

  Ya que todos los modelos van a tener las mismas funciones basicas para interactuar con la base de datos, asi como tambien la conneccion con la base de datos genero este modelo que luego permitira extender las demas clases del mismo. Permitiendo asi, en caso de que sea necesario, la posibilidad de modificar una unica clase y que se vean afectadas todas las clases que implementan estos metodos base.
-->
<?php


class EntityModel
{
  private $db;
  protected $table;
  protected $alias; 

  public function select($query)
  {
    $this->connect();
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll();
    // var_dump($results);

    // die();

    // $stmt = $this->db->prepare($query);
    // $stmt->bindParam();
    // $results = $stmt->execute();
    // var_dump($results->fetch_all());
    return $results;
  }

  public function update($data, $id)
  {
  }

  public function insert($data)
  {
  }

  public function delete($id)
  {
  }

  private function connect()
  {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

    $this->db = new PDO($dsn, DB_USER, DB_PASSWORD);
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }
}
