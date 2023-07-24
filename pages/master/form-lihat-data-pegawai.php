<?php
if (isset($_GET['nik'])) {
	$nik = $_GET['nik'];
} else {
	die("Error. No Kode Selected! ");
}
include "dist/koneksi.php";
$departemen = mysqli_query($con, 'SELECT * from tb_departemen');
$jabatan = mysqli_query($con, 'SELECT * from tb_jabatan');
$atasan = mysqli_query($con, 'SELECT * FROM tb_users WHERE tb_users.hak_akses = "pegawai"');
$ambilData = mysqli_query($con, "SELECT * FROM tb_users WHERE nik='$nik'");
$hasil = mysqli_fetch_array($ambilData);
$nik = $hasil['nik'];
?>
<section class="content-header">
	<h1>Form<small>Lihat Data Karyawan <b>#<?= $nik ?></b></small></h1>
	<ol class="breadcrumb">
		<li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li class="active">Lihat Data Karyawan</li>
	</ol>
</section>
<section class="content">
	<div class="panel panel-default" style="background-color: white;border-radius:10px">
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-3">
					<div class="text-black">Nama</a></div>
				</div>
				<div class="col-xs-">
					<div class="text-black"><?= $hasil['nama_peg']; ?></div>
				</div>
			</div>
			<div class="row" style="margin-top: 10px;">
				<div class="col-xs-3">
					<div class="text-black">username</a></div>
				</div>
				<div class="col-xs-">
					<div class="text-black"><?= $hasil['username']; ?></div>
				</div>
			</div>
			<div class="row" style="margin-top: 10px;">
				<div class="col-xs-3">
					Jenis kelamin </div>
				<div class="col-xs-">
					<div class="text-black"><?= $hasil['jk']; ?></div>
				</div>
			</div>
			<div class="row" style="margin-top: 10px;">
				<div class="col-xs-3">
					<div class="text-black">Alamat</a></div>
				</div>
				<div class="col-xs-">
					<div class="text-black"><?= $hasil['alamat']; ?></div>
				</div>
			</div>
			<div class="row" style="margin-top: 10px;">
				<div class="col-xs-3">
					<div class="text-black">No. TLpn</a></div>
				</div>
				<div class="col-xs-">
					<div class="text-black"><?= $hasil['telp']; ?></div>
				</div>
			</div>
			<div class="row" style="margin-top: 10px;">
				<div class="col-xs-3">
					<div class="text-black">Jabatan</a></div>
				</div>
				<div class="col-xs-">
					<div class="text-black"><?= $hasil['jabatan']; ?></div>
				</div>
			</div>
			<div class="row" style="margin-top: 10px;">
				<div class="col-xs-3">
					<div class="text-black">Departemen</a></div>
				</div>
				<div class="col-xs-">
					<div class="text-black"><?= $hasil['departemen']; ?></div>
				</div>
			</div>
			<div class="row" style="margin-top: 10px;">
				<div class="col-xs-3">
					<div class="text-black">Email</a></div>
				</div>
				<div class="col-xs-">
					<div class="text-black"><?= $hasil['email']; ?></div>
				</div>
			</div>
			<div class="row" style="margin-top: 10px;">
				<div class="col-xs-3">
					<div class="text-black">Tanggal Masuk</a></div>
				</div>
				<div class="col-xs-">
					<div class="text-black"><?= $hasil['tgl_masuk']; ?></div>
				</div>
			</div>
			<div class="row" style="margin-top: 10px;">
				<div class="col-xs-3">
					<div class="text-black">Sisa Cuti Tahunan</a></div>
				</div>
				<div class="col-xs-">
					<div class="text-black"><?= $hasil['hak_cuti_tahunan']; ?></div>
				</div>
			</div>
			<?php
			if ($hasil['jk'] == 'perempuan') {
			?>
				<div class="row" style="margin-top: 10px;">
					<div class="col-xs-3">
						<div class="text-black">Sisa Cuti Hamil</a></div>
					</div>
					<div class="col-xs-">
						<div class="text-black"><?= $hasil['cuti_hamil']; ?></div>
					</div>
				</div>
			<?php

			} ?>

		</div>
	</div>
</section>
<script type="text/javascript">
	$('input').attr('disabled', true);
	$('textarea').attr('disabled', true);
	$('select').attr('disabled', true);
</script>