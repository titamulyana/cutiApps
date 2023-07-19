<?php
session_start();
if (!isset($_SESSION['nik'])) {
  die("<b>Oops!</b> Access Failed.
		<p>Sistem Logout. Anda harus melakukan Login kembali.</p>
		<button type='button' onclick=location.href='index.php'>Back</button>");
}
if ($_SESSION['hak_akses'] != "pegawai") {
  die("<b>Oops!</b> Access Failed.
		<p>Anda Bukan Pegawai.</p>
		<button type='button' onclick=location.href='index.php'>Back</button>");
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/bootstrap-datetimepicker.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <script type="text/javascript" src="plugins/datatables/jquery.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<?php
include './dist/koneksi2.php';
$nik = $_SESSION['nik'];
$query = mysqli_query($con, "SELECT * from tb_users where id_atas='$nik'");
?>

<body class="hold-transition skin-red fixed sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <a href="home-pegawai.php" class="logo"><span class="logo-mini">CUTI</span><span class="logo-lg"><b>Cuti</b> ONLINE</span></a>
      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"><span class="sr-only">Toggle navigation</span></a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-inbox"></i><span class="label label-warning"></span></a>
              <ul class="dropdown-menu">
                <li class="header"></li>
              </ul>
            </li>
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src='dist/img/profile/no-image.jpg' class='user-image' alt='User Image'>
                <span class="hidden-xs">Aplikasi Pengajuan Cuti Online</span> &nbsp;<i class="fa fa-angle-down"></i>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src='dist/img/profile/no-image.jpg' class='img-circle' alt='User Image'>
                  <p>Welcome - <?php echo $_SESSION['nama_peg'] ?><small><?php echo $_SESSION['hak_akses'] ?></small></p>
                </li>
                <li class="user-body">
                  <div class="row">
                  </div>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <?php
                    setlocale(LC_TIME, 'id_ID');
                    // Get the current date
                    $currentDate = new DateTime();
                    // Format the date in Bahasa Indonesia
                    $formattedDate = $currentDate->format("l, d F Y");
                    echo $formattedDate;
                    ?>
                  </div>
                  <div class="pull-right">
                    <a href="pages/login/act-logout.php" class="btn btn-default btn-flat">Log out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <section class="sidebar">
        <ul class="sidebar-menu">
          <li class="header">MAIN NAVIGATION</li>
          <li class="treeview"><a href="home-pegawai.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></i></a></li>
          <li class="treeview"><a href="home-pegawai.php?page=form-permohonan-cuti-tahunan"><i class="fa fa-book"></i> <span>Permohonan Cuti</span></i></a>
          <li class="treeview"><a href="home-pegawai.php?page=history-cuti-pegawai"><i class="fa fa-exchange"></i> <span>History</span></a></li>
          <?php
          if ($query && mysqli_num_rows($query) > 0) {
            $dataArray = array();
            while ($row = mysqli_fetch_assoc($query)) {
              $dataArray[] = $row;
            }
            $nikList = "'" . implode("','", array_column($dataArray, 'nik')) . "'";
            $dataCuti = mysqli_query($con, "SELECT * FROM tb_cuti WHERE nik in ($nikList) AND depApproval IS NULL");
            $numRows = mysqli_num_rows($dataCuti);
            if ($numRows > 0) {
              echo "<li class='treeview'><a href='home-pegawai.php?page=approval-cuti'><i class='fa fa-book'></i>
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
              echo "<li class='treeview'><a href='home-pegawai.php?page=approval-cuti'><i class='fa fa-book'></i> <span>Approval Cuti</span></i></a>";
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
          case 'approval-cuti-pegawai':
            include "pages/transaksi/approval-cuti-pegawai.php";
            break;
          case 'form-permohonan-cuti-umum':
            include "pages/transaksi/form-permohonan-cuti-umum.php";
            break;
          case 'permohonan-cuti-umum':
            include "pages/transaksi/permohonan-cuti-umum.php";
            break;
          case 'history-cuti-pegawai':
            include "pages/view/history-cuti-pegawai.php";
            break;
          case 'approval-cuti':
            include "pages/transaksi/approval-cuti.php";
            break;
          default:
            include 'dashboard-pegawai.php';
        }
        ?>
      </section>
    </div>
    <footer class="main-footer">
      <!-- <div class="pull-right hidden-xs"><b>Version</b> 1.0</div> -->
      Copyright &copy; 2023 <a href="#" target="_blank">cuti ONLINE</a>. All rights reserved
    </footer>
  </div>
  <!-- ./wrapper -->
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
  <!-- Bootstrap WYSIHTML5 -->
  <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/app.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
</body>

</html>