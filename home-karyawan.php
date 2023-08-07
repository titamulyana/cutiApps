<?php
session_start();
if (!isset($_SESSION['nik'])) {
  die("<b>Oops!</b> Access Failed.
		<p>Sistem Logout. Anda harus melakukan Login kembali.</p>
		<button type='button' onclick=location.href='index.php'>Back</button>");
}
if ($_SESSION['hak_akses'] != "karyawan") {
  die("<b>Oops!</b> Access Failed.
		<p>Anda Bukan karyawan.</p>
		<button type='button' onclick=location.href='index.php'>Back</button>");
}
include './dist/koneksi2.php';
if (isset($_POST['ganti'])) {
  if (empty($_POST['new-password']))
    echo "<script>alert('data tidak sesuai');</script>";

  try {
    $newPassword = $_POST['new-password'];
    $nikGanti = $_SESSION['nik'];
    // menupdate password kedalam table tb_users
    $query = mysqli_query($con, "UPDATE tb_users SET `password`='$newPassword' WHERE nik=$nikGanti");

    // Mengeksekusi query ganti password
    if ($query) {
      echo "<script>alert('Password Berhasil diganti');</script>";
    } else {
      echo "<script>alert('Gagal ganti password');</script>";
    }
  } catch (Exception $e) {
    echo "<script>alert('" . $e . "');</script>";
  }
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
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dist/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="dist/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="plugins/datepicker/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <script type="text/javascript" src="plugins/datatables/jquery.js"></script>
</head>

<body class="hold-transition skin-red fixed sidebar-mini">
  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ganti Password</h4>
        </div>
        <div class="modal-body">
          <form method="POST">
            <!-- Your form fields go here -->
            <div class="form-group">
              <label for="new-password">Password Baru</label>
              <input type="password" name="new-password" class="form-control" id="new-password"
                placeholder="Enter new password" required>
            </div>
            <!-- Add other form fields as needed -->
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">BATAL</button>
              <button name="ganti" value="ganti" type="submit" class="btn btn-primary">SIMPAN</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <div class="wrapper">
    <header class="main-header">
      <a href="home-karyawan.php" class="logo" style="background-color:#BAC4FE">
        <img src=" ./dist/img/log.png" alt="Logo" style="width: 100%;  height: 100%;  object-fit: contain;">
      </a>
      <nav class=" navbar navbar-static-top" role="navigation" style="background-color:#BAC4FE">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"><span class="sr-only">Toggle
            navigation</span></a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src='dist/img/profile/no-image.jpg' class='user-image' alt='User Image'>
                <span class="hidden-xs">
                  <?php echo $_SESSION['nama_kry'] ?>
                </span> &nbsp;<i class="fa fa-angle-down"></i>
              </a>
              <ul class="dropdown-menu">
                <li class="user-footer">
                  <center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Ganti
                      Password</button></center>
                </li>
                <li class="user-footer">
                  <a href="pages/login/act-logout.php" class="btn btn-default btn-flat">Log out</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar" style="background-color: #186E89;">
      <section class="sidebar">
        <ul class="sidebar-menu">
          <li class="treeview <?= !isset($_GET['page']) ? 'active' : '' ?>"><a href="home-karyawan.php"><i
                class="fa fa-dashboard"></i> <span>Dashboard</span></i></a></li>
          <li class="treeview <?= @$_GET['page'] == 'form-permohonan-cuti-tahunan' ? 'active' : '' ?>"><a
              href="home-karyawan.php?page=form-permohonan-cuti-tahunan"><i class="fa fa-book"></i> <span>Permohonan
                Cuti</span></i></a>
          <li class="treeview <?= @$_GET['page'] == 'history-cuti-karyawan' ? 'active' : '' ?>"><a
              href="home-karyawan.php?page=history-cuti-karyawan"><i class="fa fa-exchange"></i> <span>History</span></a>
          </li>
          <?php
          $nik = $_SESSION['nik'];
          // mencari data bawahan dari table tb_users
          $query = mysqli_query($con, "SELECT * from tb_users where id_atas='$nik'");
          if ($query && mysqli_num_rows($query) > 0) {
            $dataArray = array();
            while ($row = mysqli_fetch_assoc($query)) {
              $dataArray[] = $row;
            }
            // menyimpan nik bawahan dalam bentuk array string
            $nikList = "'" . implode("','", array_column($dataArray, 'nik')) . "'";
            // mencari nik bawahan yang membutuhkan persetujuan / approval cuti di table tb_cuti
            $dataCuti = mysqli_query($con, "SELECT * FROM tb_cuti WHERE nik in ($nikList) AND depApproval IS NULL");
            $numRows = mysqli_num_rows($dataCuti);

            // jika ditemukan ada permohonan yg belum diajukan maka akan muncul "Task"
            if ($numRows > 0) {
              $actived = @$_GET['page'] == 'approval-cuti' ? 'active' : '';
              echo "<li class='treeview $actived'><a href='home-karyawan.php?page=approval-cuti'><i class='fa fa-book'></i>
                <span>Approval Cuti</span>
                <div class='custom-btn' style='display: inline-block;
                background-color: yellow;
                padding: 2px;
                border-radius: 5px;
                font-size: 14px;'
                disabled>
                <small>Task</small>
                </div></i></a>";
            } else {
              echo "<li class='treeview'><a href='home-karyawan.php?page=approval-cuti'><i class='fa fa-gear'></i> <span>Approval Cuti</span></i></a>";
            }
          }
          ?>
        </ul>
      </section>
    </aside>
    <div class="content-wrapper">
      <section class="content">
        <?php
        $page = (isset($_GET['page'])) ? $_GET['page'] : "main";
        switch ($page) {
          case 'form-permohonan-cuti-tahunan':
            include "pages/transaksi/form-permohonan-cuti-tahunan.php";
            break;
          case 'permohonan-cuti-tahunan':
            include "pages/transaksi/permohonan-cuti-tahunan.php";
            break;
          case 'approval-cuti-karyawan':
            include "pages/transaksi/approval-cuti-karyawan.php";
            break;
          case 'history-cuti-karyawan':
            include "pages/transaksi/history-cuti-karyawan.php";
            break;
          case 'approval-cuti':
            include "pages/transaksi/approval-cuti.php";
            break;
          default:
            include 'dashboard-karyawan.php';
        }
        ?>
      </section>
    </div>

  </div>
  <!-- jQuery 2.1.4 -->
  <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.5 -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- Morris.js charts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="plugins/morris/morris.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
  <!-- jvectormap -->
  <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/knob/jquery.knob.js"></script>
  <!-- Bootstrap  -->
  <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="plugins/fastclick/fastclick.js"></script>
  <script src="dist/js/app.min.js"></script>
  <script src="dist/js/pages/dashboard.js"></script>
  <script src="dist/js/demo.js"></script>
  <!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
</body>

</html>