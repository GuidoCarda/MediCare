<?php 
// include_once 'connection.php';

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  $uri = array_slice(explode('/', $_SERVER['REQUEST_URI']),2);
  var_dump($uri);
  // $email = $_POST['email'];
  // $password = $_POST['password'];
  
  // if(!$email || !$password){
  //   echo json_encode(array('error'=>"campos vacios"));
  //   exit();
  // }

  // $sql = "SELECT * FROM user WHERE email = '$email' and password = '$password'";
  // $res = $db->query($sql);

  // // if there is no user coincidence with the credentials
  // if($res->num_rows == 0){
  //   echo json_encode(array('error'=>'Credenciales invalidas'));
  //   exit();
  // }

  // // if valid credentials..
  // $_SESSION['is_authorized'] = true; 
}


// $email = $POST['email'];
// $password = $POST['password'];
// $firstName = $POST['firstName'];
// $lastName = $POST['lastName'];
// $dni = $POST['dni'];
// $birthDate = $POST['birthDate'];

// $sql = "INSERT INTO user (email, password) VALUES ('$email', '$password')";
// $sql = "INSERT INTO patient (first_name, last_name, dni, birth_date) VALUES ('$firstName', '$lastName', '$dni', '$birth_date')";

// if(!$res){
//   echo json_encode(array('error'=>'algo salio mal'));
//   exit();
// }
