

<?php 

class UserModel extends EntityModel{

  protected $table;
  protected $alias;

  private $id;
  private $email;
  private $password;

  public function __construct($id = null, $email = null, $password = null)
  {
    $this->id = $id;
    $this->email = $email;
    $this->password = $password;

    $this->table = 'user';
    $this->alias = 'u';
  }
  

  public static function checkLogin($email, $password){
    $User = new UserModel();
    $result = $User->select(
      '*',
      [
        'where' => "email = :email AND password = :password",
        'replaces' => [':email' => $email, ':password' => $password]
      ],
      true
    );

    return $result;
  }

  public static function createUser($email, $password){
    $User = new UserModel();
    $newUserId =  $User->insert(['email' => $email, 'password' => $password]);
    return $newUserId; 
  }

  public static function getUserById($userId){
    $User = new UserModel();
    $result = $User->select();
    return $result;
  }

  public static function getUserByEmail($email){
    $User = new UserModel();
    $result = $User->select(
      '*',
      [
        'where' => "email = :email",
        'replaces' => [':email' => $email]
      ],
      true
    );

    return $result;
  }
}