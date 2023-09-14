<?php
$host = "localhost";
$dbname = "ecf_crypto";
$username = "root";
$password = "";

$mysqli = new mysqli(hostname: $host, 
                     username: $username, 
                     password: $password, 
                     database: $dbname);

if ($mysqli ->connect_errno){
  die("Conenction error: " . $mysqli->connect_error);
}

return $mysqli;
 ?>