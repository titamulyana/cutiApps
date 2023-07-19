<section class="content-header">
	<h1>Edit<small>Data Pegawai</small></h1>
	<ol class="breadcrumb">
		<li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li class="active">Edit Data Pegawai</li>
	</ol>
</section>
<div class="register-box">
	<?php
	if (isset($_GET['nik'])) {
		$nik = $_GET['nik'];
	} else {
		die("Error. No Kode Selected! ");
	}
	include "dist/koneksi.php";
	if ($_POST['edit'] == "edit") {
		$nik		= $_POST['nik'];
		$nama_peg	= $_POST['nama_peg'];
		$jk			= $_POST['jk'];
		$jabatan	= $_POST['jabatan'];
		$hak_akses	= $_POST['hak_akses'];
		$tmpt_lahir	= $_POST['tmpt_lahir'];
		$tgl_lahir	= $_POST['tgl_lahir'];
		$agama		= $_POST['agama'];
		$status		= $_POST['status'];
		$telp		= $_POST['telp'];
		$email		= $_POST['email'];
		$departemen	= $_POST['departemen'];
		$id_atas	= $_POST['id_atas'];
		$alamat		= $_POST['alamat'];
		$hak_cuti_tahunan	= $_POST['hak_cuti_tahunan'];
		$cuti_hamil		= $_POST['cuti_hamil'];
		$user_name		= $_POST['username'];
		$tgl_masuk = $_POST['tgl_masuk'];

		if (
			empty($_POST['nik']) || empty($_POST['nama_peg']) || empty($_POST['jk']) || empty($_POST['jabatan'])
			|| empty($_POST['hak_akses']) || empty($_POST['tmpt_lahir']) || empty($_POST['tgl_lahir']) || empty($_POST['agama']) ||
			empty($_POST['status']) || empty($_POST['telp']) || empty($_POST['email']) || empty($_POST['departemen']) ||
			empty($_POST['id_atas']) || empty($_POST['alamat']) || empty($_POST['hak_cuti_tahunan']) || empty($_POST['cuti_hamil'])
		) {
			echo "<div class='register-logo'><b>Oops!</b> Data Tidak Lengkap.</div>
			<div class='box box-primary'>
				<div class='register-box-body'>
					<p>Harap periksa kembali dan pastikan data yang Anda masukan lengkap dan benar</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-admin.php?page=form-master-pegawai' class='btn btn-block btn-warning'>Back</button>
						</div>
					</div>
				</div>
			</div>";
			die();
		}

		$update = mysqli_query($con, "UPDATE tb_users SET username = '$user_name', nama_peg = '$nama_peg', jk = '$jk', jabatan = '$jabatan', hak_akses = '$hak_akses', tmpt_lahir = '$tmpt_lahir', tgl_lahir = '$tgl_lahir', agama = '$agama', status = '$status', telp = '$telp', alamat = '$alamat', hak_cuti_tahunan = '$hak_cuti_tahunan', cuti_hamil = '$cuti_hamil', email = '$email', departemen = '$departemen', tgl_masuk = '$tgl_masuk', soft_delete = 0, id_atas = '$id_atas', approval = 0 WHERE nik = '$nik'");
		if ($update) {
			echo "<div class='register-logo'><b>Edit</b> Successful!</div>	
				<div class='register-box-body'>
					<p>Edit Data Pegawai " . $nik . " Berhasil</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-admin.php?page=form-master-pegawai' class='btn btn-primary btn-block btn-flat'>Next >></button>
						</div>
					</div>
				</div>";
		} else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	?>
</div>