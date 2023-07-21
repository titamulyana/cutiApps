<?php
session_start();
if (!isset($_SESSION['nik'])) {
	die("<b>Oops!</b> Access Failed.
		<p>Sistem Logout. Anda harus melakukan Login kembali.</p>
		<button type='button' onclick=location.href='index.php'>Back</button>");
}
if ($_SESSION['hak_akses'] != "hrd") {
	die("<b>Oops!</b> Access Failed.
		<p>Anda Bukan Admin.</p>
		<button type='button' onclick=location.href='index.php'>Back</button>");
}
include './dist/koneksi2.php';
if ($_POST['ganti'] == "ganti") {
	if (empty($_POST['new-password']))
		echo "<script>alert('data tidak sesuai');</script>";

	try {
		$newPassword = $_POST['new-password'];
		$nikGanti = $_SESSION['nik'];

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
							<input type="password" name="new-password" class="form-control" id="new-password" placeholder="Enter new password" required>
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
			<a href="home-admin.php" style="background-color: #088395;" class="logo">
				<img src=" ./dist/img/log.png" alt="Logo" style="width: 100%;  height: 100%;  object-fit: contain;">
			</a>
			<nav class="navbar navbar-static-top" style="background-color: #088395;" role="navigation">
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"><span class="sr-only">Toggle navigation</span></a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src='dist/img/profile/no-image.jpg' class='user-image' alt='User Image'>
								<span class="hidden-xs"><?php echo $_SESSION['nama_peg'] ?></span> &nbsp;<i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu">
								<li class="user-footer">
									<center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Ganti Password</button></center>
								</li>
								<li class="user-footer">
									<a href="pages/login/act-logout.php" class="btn btn-default btn-flat">Log out</a>
								</li>
						</li>
					</ul>
					</li>
					</ul>
				</div>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar" style="background-color: #0A4D68 !important;">
				<ul class="sidebar-menu">
					<li class="header" style="background-color: #0A4D68 !important;">MAIN NAVIGATION</li>
					<li class="treeview"><a href="home-admin.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></i></a></li>
					<li class="treeview"><a href="#"><i class="fa fa-book"></i> <span>Master Data</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<!-- <li><a href="home-admin.php?page=form-master-user"> <i class="fa fa-caret-right"></i> User</a></li> -->
							<li><a href="home-admin.php?page=form-master-pegawai"> <i class="fa fa-users"></i> Pegawai Aktif</a></li>
							<li><a href="home-admin.php?page=pegawai-tidak-aktif"> <i class="fa fa-users"></i> Pegawai Tidak Aktif</a></li>
							<li><a href="home-admin.php?page=form-master-departemen"> <i class="fa fa-briefcase"></i> Departement</a></li>
							<li><a href="home-admin.php?page=form-master-jabatan"> <i class="fa fa-th-list"></i> Jabatan</a></li>
							<li><a href="home-admin.php?page=form-master-jenis-cuti"> <i class="fa fa-tasks"></i> Jenis Cuti</a></li>
						</ul>
					</li>
					<li class='treeview'><a href='home-admin.php?page=form-permohonan-cuti-tahunan'><i class='fa fa-calendar'></i> <span>Permohonan Cuti</span></i></a>
					<li class="treeview"><a href="home-admin.php?page=history-cuti-hrd"><i class="fa fa-exchange"></i> <span>History</span></a></li>
					<li class='treeview'><a href='home-admin.php?page=approval-cuti'><i class='fa fa-calendar'></i> <span>Approval Cuti</span></i></a>
					<li class="treeview"><a href="#"><i class="fa fa-print"></i> <span>Report</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<!-- <li><a href="home-admin.php?page=form-master-user"> <i class="fa fa-caret-right"></i> User</a></li> -->
							<li><a href="home-admin.php?page=report-approved-cuti"> <i class="fa fa-check-square-o"></i> Approved</a></li>
							<li><a href="home-admin.php?page=report-all-cuti"> <i class="fa fa-minus-square-o"></i> All</a></li>
						</ul>
					</li>
				</ul>
			</section>
		</aside>
		<div class="content-wrapper">
			<section class="content">
				<?php
				$page = (isset($_GET['page'])) ? $_GET['page'] : "main";
				switch ($page) {
					case 'form-master-pegawai':
						include "pages/master/form-master-pegawai.php";
						break;
					case 'form-edit-data-pegawai':
						include "pages/master/form-edit-data-pegawai.php";
						break;
					case 'master-user':
						include "pages/master/master-user.php";
						break;
					case 'master-pegawai':
						include "pages/master/master-pegawai.php";
						break;
					case 'delete-data-pegawai':
						include "pages/master/delete-data-pegawai.php";
						break;
					case 'edit-data-pegawai':
						include "pages/master/edit-data-pegawai.php";
						break;
					case 'form-lihat-data-pegawai':
						include "pages/master/form-lihat-data-pegawai.php";
						break;
					case 'form-master-departemen':
						include "pages/master/form-master-data-departemen.php";
						break;
					case 'master-departemen':
						include "pages/master/master-departemen.php";
						break;
					case 'form-edit-data-departemen':
						include "pages/master/form-edit-data-departemen.php";
						break;
					case 'edit-data-departemen':
						include "pages/master/edit-data-departemen.php";
						break;
					case 'delete-data-departemen':
						include "pages/master/delete-data-departemen.php";
						break;
					case 'approval-cuti':
						include "pages/approval-cuti-hr/approval-cuti.php";
						break;
					case 'approval-cuti-pegawai':
						include "pages/approval-cuti-hr/approval-cuti-pegawai.php";
						break;
					case 'report-approved-cuti':
						include "pages/report/approved.php";
						break;
					case 'report-all-cuti':
						include "pages/report/all-cuti.php";
						break;
					case 'form-master-jabatan':
						include "pages/master/form-master-data-jabatan.php";
						break;
					case 'master-jabatan':
						include "pages/master/master-jabatan.php";
						break;
					case 'form-edit-data-jabatan':
						include "pages/master/form-edit-data-jabatan.php";
						break;
					case 'edit-data-jabatan':
						include "pages/master/edit-data-jabatan.php";
						break;
					case 'delete-data-jabatan':
						include "pages/master/delete-data-jabatan.php";
						break;
					case 'form-master-jenis-cuti':
						include "pages/master/form-master-data-jenis-cuti.php";
						break;
					case 'master-jenis-cuti':
						include "pages/master/master-jenis-cuti.php";
						break;
					case 'form-edit-data-jenis-cuti':
						include "pages/master/form-edit-data-jenis-cuti.php";
						break;
					case 'edit-data-jenis-cuti':
						include "pages/master/edit-data-jenis-cuti.php";
						break;
					case 'delete-data-jenis-cuti':
						include "pages/master/delete-data-jenis-cuti.php";
						break;
					case 'reset-password':
						include "pages/master/reset-password.php";
						break;
					case 'pegawai-tidak-aktif':
						include "pages/master/pegawai-inactive.php";
						break;
					case 'form-permohonan-cuti-tahunan':
						include "pages/permohonan-cuti-hr/form-permohonan-cuti-tahunan.php";
						break;
					case 'permohonan-cuti':
						include "pages/permohonan-cuti-hr/permohonan-cuti-tahunan.php";
						break;
					case 'history-cuti-hrd':
						include "pages/view/history-cuti-hrd.php";
						break;
					default:
						include 'dashboard.php';
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