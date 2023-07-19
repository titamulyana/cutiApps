<?php
function loadEnv($filePath)
{
  $absolutePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $filePath;

  if (!file_exists($absolutePath)) {
    throw new Exception('.env file not found');
  }

  $lines = file($absolutePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) {
      continue;
    }

    list($key, $value) = explode('=', $line, 2);
    $key = trim($key);
    $value = trim($value);

    if (!array_key_exists($key, $_SERVER) && !array_key_exists($key, $_ENV)) {
      $_ENV[$key] = $value;
      $_SERVER[$key] = $value;
    }
  }
}

loadEnv('.env');


// Menggunakan variabel-variabel lingkungan
$hostname = $_ENV['DB_HOST'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$databasename =  $_ENV['DB_NAME'];

$con = mysqli_connect($hostname, $username, $password, $databasename);

if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

?>