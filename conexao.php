<?php

$hostname = "localhost";
$database = "portaria";
$username = "user_portaria";  
$password = "Mk[0U6a{9c&H";

$con = mysqli_connect($hostname, $username, $password, $database);
mysqli_set_charset($con, "utf8");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}