

<?php

function isLogged()
{
  return isset($_SESSION['id']);
}

function isPost(){
  return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function hasEmptyFields($requiredFields){
  foreach ($requiredFields as $field) {
    if(empty($_POST[$field])){
      return true;
    }
  }
  return false;
}

function pluralizeIfNeeded($number, $str){
  return $number > 1 ? $str . 's': $str;
}


?>