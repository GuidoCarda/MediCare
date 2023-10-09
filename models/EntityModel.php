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

  public function insert($data)
  {
    // arreglo de reemplazos
    $replaces = [];
    // por cada columna de la tabla genero un reemplazo
    foreach( $data as $col => $val ){
      $replaces[ ":$col" ] = $val;
    }

    // una vez generado el arreglo de reemplazos, genero los strings para la query
    $columns = implode( "," , array_keys($data) ); 
    $values = implode(", ", array_keys($replaces) );

    // genero la query
    $query = "INSERT INTO $this->table ( $columns ) VALUES ( $values )";

    // conecto a la base de datos
    $this->connect();
    // preparo la query
    $stmt = $this->db->prepare($query);
    // ejecuto la query
    $stmt->execute( $replaces );
    // devuelvo el id del registro insertado
    return $this->db->lastInsertId();
  }

  public function update($data, $id)
  {
    // arreglo de reemplazos
    $replaces = [];
    // arreglo de valores
    $values = [];

    // por cada columna de la tabla genero un reemplazo y un valor
    foreach( $data as $col => $val ){
      $values[] = "$col = :$col";
      $replaces[ ":$col" ] = $val;
    }

    // genero el string de valores
    $values = implode( " ", $values );

    // genero la query
    $query = "UPDATE $this->table SET $values WHERE id = :id LIMIT 1";
    // agrego el id al arreglo de reemplazos
    $replaces[ ":id" ] = $id;

    // conecto a la base de datos
    $this->connect();
    // preparo la query
    $stmt = $this->db->prepare($query);
    // ejecuto la query
    $stmt->execute( $replaces );
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
