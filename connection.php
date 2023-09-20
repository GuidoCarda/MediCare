<?php

$hostname = 'localhost';
$username = "root";
$password = "";
$database = 'medicare';

$db = new mysqli($hostname, $username, $password, $database);

if ($db->connect_error) {
  echo "Error {$db->connect_errno}: {$db->connect_error}";
  exit;
}
