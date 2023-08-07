<?php
ob_start();
session_start();

// check session yang tersimapn
if (isset($_SESSION['nik']) && isset($_SESSION['nama_kry']) && isset($_SESSION['hak_akses'])) {

  if ($_SESSION['hak_akses'] === "hrd") {
    // menuju ke halaman hrd
    echo "<script>document.location.href='home-admin.php';</script>";
  } else if ($_SESSION['hak_akses'] === "karyawan") {
    // menuju kehalaman karyawan
    echo "<script>document.location.href='home-karyawan.php';</script>";
  }
  echo "<script>document.location.href='pages/login/act-logout.php';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Aplikasi Pengajuan Cuti Online</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-image: url("dist/img/back.jpg");
      background-repeat: no-repeat;
      /* background-size: cover; */
      background-position: center;
    }

    .login-container {
      background-color: rgba(0, 34, 51, 0.3);
      box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
      border-radius: 20px;
      padding: 30px;
      width: 350px;
      text-align: center;
    }

    .login-logo {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
      color: #fff;
    }

    .login-form input {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .login-form button {
      background-color: #007bff;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }

    .login-form button:hover {
      background-color: #0056b3;
    }

    .login-form p {
      color: #888;
      margin-top: 15px;
    }
  </style>
</head>

<body>
  <section class="content">
    <?php
    $page = (isset($_GET['page'])) ? $_GET['page'] : "main";
    switch ($page) {
      case 'act-login':
        include "pages/login/act-login.php";
        break;
      default:
        include 'pages/login/form-login.php';
    }
    ?>
  </section>
</body>

</html>