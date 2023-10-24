<!-- 
  EntityModel

  Ya que todos los modelos van a tener las mismas funciones basicas para interactuar con la base de datos, asi como tambien la conneccion con la base de datos genero este modelo que luego permitira extender las demas clases del mismo. Permitiendo asi, en caso de que sea necesario, la posibilidad de modificar una unica clase y que se vean afectadas todas las clases que implementan estos metodos base.
-->
<?php


class EntityModel
{
  private $db;
  protected $table = '';
  protected $alias = '';
  protected $primary = 'id';

  public function __construct($table = null, $alias = null, $primary = null)
  {
    // Si se reciben parametros, los asigno a las propiedades de la clase
    // De lo contrario se mantienen los valores por defecto
    $this->table = $table ?? $this->table;
    $this->alias = $alias ?? $this->alias;
    $this->primary = $primary ?? $this->primary;
  }

  /** 
   * Ejecuta una query en la base de datos
   * @param string $columns columnas a seleccionar
   * @param array $filters filtros para la query
   * @param bool $onlyOneResult indica si se debe devolver un solo resultado
   * @return array resultado de la query
   * */
  public function select(
    $columns = '*',
    $filters = [],
    $onlyOneResult = false
  ) {
    // Genero la primer parte de la query, contiene las columnas, tabla y alias
    $query = "SELECT $columns FROM $this->table $this->alias";

    // Si se envian filtros, los agrego a la query
    if (isset($filters['joins'])) {
      $joins = [];
      // por cada join, genero el string correspondiente
      foreach ($filters['joins'] as $j) {
        $type = strtoupper($j['type'] ?? '');
        $joins[] = "$type JOIN $j[table] ON $j[on]";
      }
      // agrego los joins a la query
      $query .= ' ' . implode("\n", $joins);
    }

    if (isset($filters['where'])) {
      $query .= ' WHERE ' . $filters['where'];
    }

    if (isset($filters['group'])) {
      $query .= ' GROUP BY ' . $filters['group'];
    }

    if (isset($filters['order'])) {
      $query .= ' ORDER BY ' . $filters['order'];
    }

    // si se reciben remplazos para la query, los almaceno en una variable para luego pasarlos a la funcion execute
    $replaces_array = $filters['replaces'] ?? NULL;

    $this->connect();
    $stmt = $this->db->prepare($query);
    $stmt->execute($replaces_array);
    return $onlyOneResult ? $stmt->fetch() : $stmt->fetchAll();
  }

  /**
   * Inserta un registro en la base de datos
   * @param array $data arreglo con los datos a insertar
   * @return int id del registro insertado
   */
  public function insert($data)
  {
    // arreglo de reemplazos
    $replaces = [];
    // por cada columna de la tabla genero un reemplazo
    foreach ($data as $col => $val) {
      $replaces[":$col"] = $val;
    }

    // una vez generado el arreglo de reemplazos, genero los strings para la query
    $columns = implode(", ", array_keys($data));
    $values = implode(", ", array_keys($replaces));

    // genero la query
    $query = "INSERT INTO $this->table ( $columns ) VALUES ( $values )";

    // conecto a la base de datos
    $this->connect();
    // preparo la query
    $stmt = $this->db->prepare($query);
    // ejecuto la query
    $stmt->execute($replaces);
    // devuelvo el id del registro insertado
    return $this->db->lastInsertId();
  }

  /**
   * Actualiza un registro en base a un id
   * @param array $data arreglo con los datos a actualizar
   * @param int $id id del registro a actualizar
   * @return int cantidad de registros actualizados
   */
  public function update($data, $id)
  {
    // arreglo de reemplazos
    $replaces = [];
    // arreglo de valores
    $values = [];

    // por cada columna de la tabla genero un reemplazo y un valor
    foreach ($data as $col => $val) {
      $values[] = "$col = :$col";
      $replaces[":$col"] = $val;
    }

    // genero el string de valores
    $values = implode(" , ", $values);

    // genero la query
    $query = "UPDATE $this->table SET $values WHERE id = :id LIMIT 1";
    // agrego el id al arreglo de reemplazos
    $replaces[":id"] = $id;

    $this->connect();
    // preparo la query
    $stmt = $this->db->prepare($query);
    // ejecuto la query
    $stmt->execute($replaces);
    return $stmt->rowCount();
  }

  // Elimino un registro en base a un id
  public function delete($id)
  {
    $query = "DELETE FROM $this->table WHERE $this->primary = :id LIMIT 1";
    $this->connect();
    $stmt = $this->db->prepare($query);
    $stmt->execute([
      ':id' => $id
    ]);
  }


  private function connect()
  {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

    $this->db = new PDO($dsn, DB_USER, DB_PASSWORD);
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }

  public function setTable($table)
  {
    $this->table = $table;
  }

  public function getTable()
  {
    return $this->table;
  }
}
