<section class="content-header">
	<h1>Input<small>Data Pegawai</small></h1>
	<ol class="breadcrumb">
		<li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li class="active">Input Data Pegawai</li>
	</ol>
</section>
<div class="register-box">
	<?php
	if (@$_POST['save'] == "save") {
		$nik		= htmlspecialchars($_POST['nik']);
		$nama_peg	= htmlspecialchars($_POST['nama_peg']);
		$jk			= htmlspecialchars($_POST['jk']);
		$jabatan	= htmlspecialchars($_POST['jabatan']);
		$hak_akses	= htmlspecialchars($_POST['hak_akses']);
		$tmpt_lahir	= htmlspecialchars($_POST['tmpt_lahir']);
		$tgl_lahir	= htmlspecialchars($_POST['tgl_lahir']);
		$agama		= htmlspecialchars($_POST['agama']);
		$status		= htmlspecialchars($_POST['status']);
		$telp		= htmlspecialchars($_POST['telp']);
		$email		= htmlspecialchars($_POST['email']);
		$departemen	= htmlspecialchars($_POST['departemen']);
		$id_atas	= htmlspecialchars($_POST['id_atas']);
		$alamat		= htmlspecialchars($_POST['alamat']);
		$hak_cuti_tahunan	= htmlspecialchars($_POST['hak_cuti_tahunan']);
		$cuti_hamil = isset($_POST['cuti_hamil']) && $_POST['cuti_hamil'] !== '' ? htmlspecialchars($_POST['cuti_hamil']) : 'null';
		$user_name		= htmlspecialchars($_POST['username']);
		$tgl_masuk = htmlspecialchars($_POST['tgl_masuk']);

		include "dist/koneksi.php";

		if (
			empty($_POST['nik']) || empty($_POST['nama_peg']) || empty($_POST['jk']) || empty($_POST['jabatan'])
			|| empty($_POST['hak_akses']) || empty($_POST['tmpt_lahir']) || empty($_POST['tgl_lahir']) || empty($_POST['agama']) ||
			empty($_POST['status']) || empty($_POST['telp']) || empty($_POST['email']) || empty($_POST['departemen']) ||
			empty($_POST['id_atas']) || empty($_POST['alamat']) || empty($_POST['hak_cuti_tahunan']) || empty($_POST['cuti_hamil'])
		) {
			$_SESSION['form_input_pegawai'] = [
				'nik' => $nik,
				'nama_peg' => $nama_peg,
				'jk' => $jk,
				'jabatan' => $jabatan,
				'hak_akses' => $hak_akses,
				'tmpt_lahir' => $tmpt_lahir,
				'tgl_lahir' => $tgl_lahir,
				'agama' => $agama,
				'status' => $status,
				'telp' => $telp,
				'email' => $email,
				'departemen' => $departemen,
				'id_atas' => $id_atas,
				'alamat' => $alamat,
				'hak_cuti_tahunan' => $hak_cuti_tahunan,
				'cuti_hamil' => $cuti_hamil,
				'username' => $user_name,
				'tgl_masuk' => $tgl_masuk
			];

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
		} else {
			// echo $tgl_lahir; die();
			$insert = "INSERT INTO tb_users (nik, username, password, nama_peg, jk, jabatan, hak_akses, tmpt_lahir, tgl_lahir, agama, status, telp, alamat, hak_cuti_tahunan, cuti_hamil, email, departemen, tgl_masuk, soft_delete, id_atas, approval) VALUES 
			('$nik', '$user_name', '123', '$nama_peg', '$jk', '$jabatan', '$hak_akses', '$tmpt_lahir', '$tgl_lahir', '$agama', '$status', '$telp', '$alamat', '$hak_cuti_tahunan', '$cuti_hamil', '$email', '$departemen', '$tgl_masuk', 0, '$id_atas', 0)";
			$query = mysqli_query($con, $insert);
			unset($_SESSION['form_input_pegawai']);
			if ($query) {
				echo "<div class='register-logo'><b>Input Data</b> Successful!</div>	
				<div class='register-box-body'>
					<p>Input Data Pegawai Berhasil</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-admin.php?page=form-master-pegawai' class='btn btn-danger btn-block btn-flat'>Next >></button>
						</div>
					</div>
				</div>";
			} else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	?>
</div>