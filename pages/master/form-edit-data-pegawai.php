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
	<h1>Form<small>Edit Data Pegawai <b>#<?= $nik ?></b></small></h1>
	<ol class="breadcrumb">
		<li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li class="active">Edit Data Pegawai</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<form action="home-admin.php?page=edit-data-pegawai&nik=<?= $nik ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-3 control-label">NIK</label>
							<div class="col-sm-7">
								<input type="text" name="nik" id="nik" class="form-control" value="<?php echo $hasil['nik']; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Pegawai</label>
							<div class="col-sm-7">
								<input value="<?php echo $hasil['nama_peg']; ?>" type="text" name="nama_peg" class="form-control" maxlength="64">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Username</label>
							<div class="col-sm-7">
								<input value="<?php echo $hasil['username']; ?>" type="text" name="username" class="form-control" maxlength="64">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Jenis Kelamin</label>
							<div class="col-sm-7">
								<select name="jk" class="form-control">
									<option value="">Pilih</option>
									<option <?php
											echo $hasil['jk'] === "laki-laki" ? 'selected' : '';
											?> value="laki-laki">Laki-laki</option>
									<option <?php
											echo $hasil['jk'] === "perempuan" ? 'selected' : '';
											?> value="perempuan">Perempuan</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Jabatan</label>
							<div class="col-sm-7">
								<select name="jabatan" class="form-control">
									<option value="">Pilih</option>
									<?php
									while ($row = mysqli_fetch_assoc($jabatan)) {
									?>
										<option <?php
												echo $hasil['jabatan'] == $row['nama'] ? 'selected' : '';
												?> value="<?php echo $row['nama'] ?>"><?php echo $row['nama'] ?></option>
									<?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Hak Akses</label>
							<div class="col-sm-7">
								<select name="hak_akses" class="form-control">
									<option value="">Pilih</option>
									<option <?php
											echo $hasil['hak_akses'] === "hrd" ? 'selected' : '';
											?> value="hrd">HRD</option>
									<option <?php
											echo $hasil['hak_akses'] === "pegawai" ? 'selected' : '';
											?> value="pegawai">Pegawai</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tempat, Tanggal Lahir</label>
							<div class="col-sm-3">
								<input value="<?php echo $hasil['tmpt_lahir']; ?>" type="text" name="tmpt_lahir" class="form-control" maxlength="32">
							</div>
							<div class="input-group date form_date col-sm-3" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
								<input value="<?php echo $hasil['tgl_lahir']; ?>" type="text" name="tgl_lahir" class="form-control"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Agama</label>
							<div class="col-sm-7">
								<select name="agama" class="form-control">
									<option value="">Pilih</option>
									<option <?php
											echo $hasil['agama'] == "islam" ? 'selected' : '';
											?> value="islam">Islam</option>
									<option <?php
											echo $hasil['agama'] == "protestan" ? 'selected' : '';
											?> value="protestan">Protestan</option>
									<option <?php
											echo $hasil['agama'] == "katolik" ? 'selected' : '';
											?> value="katolik">Katolik</option>
									<option <?php
											echo $hasil['agama'] == "hindu" ? 'selected' : '';
											?> value="hindu">Hindu</option>
									<option <?php
											echo $hasil['agama'] == "budha" ? 'selected' : '';
											?> value="budha">Budha</option>
									<option <?php
											echo $hasil['agama'] == "kepercayaan" ? 'selected' : '';
											?> value="kepercayaan">Kepercayaan</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Status</label>
							<div class="col-sm-7">
								<select name="status" class="form-control">
									<option value="">Pilih</option>
									<option <?php
											echo $hasil['status'] === "single" ? 'selected' : '';
											?> value="single">Single</option>
									<option <?php
											echo $hasil['status'] === 'married' ? 'selected' : '';
											?> value="married">Married</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">No. Telp</label>
							<div class="col-sm-7">
								<input value="<?php echo $hasil['telp']; ?>" type="text" name="telp" class="form-control" maxlength="13">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Email</label>
							<div class="col-sm-7">
								<input value="<?php echo $hasil['email']; ?>" type="email" name="email" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Departemen</label>
							<div class="col-sm-7">
								<select name="departemen" class="form-control">
									<option value="">Pilih</option>
									<?php
									while ($row = mysqli_fetch_assoc($departemen)) {
									?>
										<option <?php
												if ($hasil['departemen'] == $row['nama']) {
													echo 'selected';
												}
												?> value="<?php echo $row['nama'] ?>"><?php echo $row['nama'] ?></option>
									<?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Atasan</label>
							<div class="col-sm-7">
								<select name="id_atas" class="form-control">
									<option value="">Pilih</option>
									<?php
									while ($row = mysqli_fetch_assoc($atasan)) {
									?>
										<option <?php
												if ($hasil['id_atas'] == $row['nik']) {
													echo 'selected';
												}
												?> value="<?php echo $row['nik'] ?>"><?php echo $row['nama_peg'] ?></option>
									<?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Alamat</label>
							<div class="col-sm-7">
								<textarea type="text" name="alamat" class="form-control" maxlength="512"><?php echo $hasil['alamat']; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Hak Cuti Tahunan</label>
							<div class="col-sm-7">
								<input value="<?php echo $hasil['hak_cuti_tahunan']; ?>" type="number" name="hak_cuti_tahunan" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Cuti Hamil</label>
							<div class="col-sm-7">
								<input value="<?php echo $hasil['cuti_hamil']; ?>" type="number" name="cuti_hamil" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tanggal Masuk</label>
							<div class="col-sm-7">
								<div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
									<input value="<?php echo $hasil['tgl_masuk']; ?>" type="text" name="tgl_masuk" class="form-control"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-7">
								<button type="submit" name="edit" value="edit" class="btn btn-danger">Save</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<!-- datepicker -->
<script type="text/javascript" src="plugins/datepicker/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="plugins/datepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="plugins/datepicker/js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript" src="../../dist/js/pages/form-pegawai.js"></script>
<script type="text/javascript">
	$('.form_date').datetimepicker({
		language: 'id',
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
	});
</script>