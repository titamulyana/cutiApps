<?php


// Menggunakan variabel-variabel lingkungan
$hostname ='localhost';
$username = 'root';
$password = '';
$databasename = 'db_cuti';

$con = mysqli_connect($hostname, $username, $password, $databasename);

if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

?>