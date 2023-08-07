<section class="content-header">
	<h1>Master<small>Data Karyawan</small></h1>
	<ol class="breadcrumb">
		<li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li class="active">Data Karyawan</li>
	</ol>
</section>
<?php
include "dist/koneksi.php";
//fungsi kode otomatis
$departemen = mysqli_query($con, 'SELECT * from tb_departemen');
$jabatan = mysqli_query($con, 'SELECT * from tb_jabatan');
$atasan = mysqli_query($con, 'SELECT * FROM tb_users');
$karyawan = mysqli_query($con, "SELECT * from tb_users WHERE soft_delete = '0'");
?>

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
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body" <div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title"><i class="fa fa-plus"></i> Add Data Karyawan<a
									data-toggle="collapse" data-target="#formkaryawan" href="#formkaryawan"
									class="collapsed"></a></h4>
						</div>
						<div id="formkaryawan" class="panel-collapse collapse">
							<div class="panel-body">
								<form action="home-admin.php?page=master-karyawan" class="form-horizontal" method="POST"
									enctype="multipart/form-data">
									<div class="form-group">
										<label class="col-sm-3 control-label">NIK</label>
										<div class="col-sm-7">
											<input
												oninput="this.value = this.value.replace(/[^0-9\-]+/g, '').replace(/(\..*)\./g, '$1');"
												maxlength="10" required type="text" name="nik" id="nik"
												class="form-control"
												value="<?= @$_SESSION['form_input_karyawan']['nik'] ?>" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Nama Karyawan</label>
										<div class="col-sm-7">
											<input required type="text" name="nama_kry" class="form-control"
												maxlength="64"
												value="<?= @$_SESSION['form_input_karyawan']['nama_kry'] ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Username</label>
										<div class="col-sm-7">
											<input required type="text" name="username" class="form-control"
												maxlength="64"
												value="<?= @$_SESSION['form_input_karyawan']['username'] ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Jenis Kelamin</label>
										<div class="col-sm-7">
											<select name="jk" class="form-control jenis-kelamin">
												<option value="">Pilih</option>
												<option value="laki-laki"
													<?= (@$_SESSION['form_input_karyawan']['jk'] == 'laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
												<option value="perempuan"
													<?= (@$_SESSION['form_input_karyawan']['jk'] == 'perempuan') ? 'selected' : ''; ?>>Perempuan</option>
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
													$selected = ($_SESSION['form_input_karyawan']['jabatan'] == $row['nama']) ? 'selected' : '';
													?>
													<option value="<?php echo $row['nama'] ?>" <?php echo $selected ?>><?php echo $row['nama'] ?></option>
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
												<option value="hrd"
													<?= (@$_SESSION['form_input_karyawan']['hak_akses'] == 'hrd') ? 'selected' : ''; ?>>HRD</option>
												<option value="karyawan"
													<?= (@$_SESSION['form_input_karyawan']['hak_akses'] == 'karyawan') ? 'selected' : ''; ?>>Karyawan</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Tempat, Tanggal Lahir</label>
										<div class="col-sm-3">
											<input required type="text" name="tmpt_lahir" class="form-control"
												maxlength="32"
												value="<?= @$_SESSION['form_input_karyawan']['tmpt_lahir'] ?>">
										</div>
										<div class="input-group date form_date col-sm-3" data-date=""
											data-date-format="yyyy-mm-dd" data-link-field="dtp_input2"
											data-link-format="yyyy-mm-dd">
											<input required type="text" name="tgl_lahir" class="form-control"
												value="<?= @$_SESSION['form_input_karyawan']['tgl_lahir'] ?>"><span
												class="input-group-addon"><span
													class="glyphicon glyphicon-calendar"></span></span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Agama</label>
										<div class="col-sm-7">
											<select name="agama" class="form-control">
												<option value="">Pilih</option>
												<option value="Islam"
													<?= (@$_SESSION['form_input_karyawan']['agama'] == 'Islam') ? 'selected' : ''; ?>>Islam</option>
												<option value="Protestan"
													<?= (@$_SESSION['form_input_karyawan']['agama'] == 'Protestan') ? 'selected' : ''; ?>>Protestan</option>
												<option value="Katolik"
													<?= (@$_SESSION['form_input_karyawan']['agama'] == 'Katolik') ? 'selected' : ''; ?>>Katolik</option>
												<option value="Hindu"
													<?= (@$_SESSION['form_input_karyawan']['agama'] == 'Hindu') ? 'selected' : ''; ?>>Hindu</option>
												<option value="Budha"
													<?= (@$_SESSION['form_input_karyawan']['agama'] == 'Budha') ? 'selected' : ''; ?>>Budha</option>
												<option value="Kepercayaan"
													<?= (@$_SESSION['form_input_karyawan']['agama'] == 'Kepercayaan') ? 'selected' : ''; ?>>Kepercayaan</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Status</label>
										<div class="col-sm-7">
											<select name="status" class="form-control">
												<option value="">Pilih</option>
												<option value="single" value="Kepercayaan"
													<?= (@$_SESSION['form_input_karyawan']['status'] == 'single') ? 'selected' : ''; ?>>Single</option>
												<option value="married" value="Kepercayaan"
													<?= (@$_SESSION['form_input_karyawan']['status'] == 'married') ? 'selected' : ''; ?>>Married</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">No. Telp</label>
										<div class="col-sm-7">
											<input required type="text" name="telp" class="form-control" maxlength="13"
												value="<?= @$_SESSION['form_input_karyawan']['telp'] ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Email</label>
										<div class="col-sm-7">
											<input required type="email" name="email" class="form-control"
												value="<?= @$_SESSION['form_input_karyawan']['email'] ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Departemen</label>
										<div class="col-sm-7">
											<select name="departemen" class="form-control">
												<option value="">Pilih</option>
												<?php
												while ($row = mysqli_fetch_assoc($departemen)) {
													$selectedDep = ($_SESSION['form_input_karyawan']['departemen'] == $row['nama']) ? 'selected' : '';
													?>
													<option value="<?php echo $row['nama'] ?>" <?= $selectedDep ?>><?php echo $row['nama'] ?></option>
													<?php
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Atasan</label>
										<div class="col-sm-7">
											<select name="id_atas" class="form-control selectpicker"
												data-live-search="true">
												<option value="">Pilih</option>
												<?php
												while ($row = mysqli_fetch_assoc($atasan)) {
													$selectedAtasan = ($_SESSION['form_input_karyawan']['id_atas'] == $row['nik']) ? 'selected' : '';
													?>
													<option value="<?php echo $row['nik'] ?>" <?= $selectedAtasan ?>><?php echo $row['nama_kry'] ?></option>
													<?php
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Alamat</label>
										<div class="col-sm-7">
											<textarea type="text" name="alamat" class="form-control"
												maxlength="512"><?= @$_SESSION['form_input_karyawan']['alamat'] ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Hak Cuti Tahunan</label>
										<div class="col-sm-7">
											<input required type="number" name="hak_cuti_tahunan"
												class="form-control validation-cuti-tahunan"
												value="<?= @$_SESSION['form_input_karyawan']['hak_cuti_tahunan'] ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Cuti Hamil</label>
										<div class="col-sm-7">
											<input required type="number" name="cuti_hamil"
												class="form-control cuti-hamil validation-cuti-hamil"
												value="<?= isset($_SESSION['form_input_karyawan']['cuti_hamil']) ? $_SESSION['form_input_karyawan']['cuti_hamil'] : '' ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Tanggal Masuk</label>
										<div class="col-sm-7">
											<div class="input-group date form_date" data-date=""
												data-date-format="yyyy-mm-dd" data-link-field="dtp_input2"
												data-link-format="yyyy-mm-dd">
												<input required type="text" name="tgl_masuk" class="form-control"
													value="<?= @$_SESSION['form_input_karyawan']['tgl_masuk'] ?>"><span
													class="input-group-addon"><span
														class="glyphicon glyphicon-calendar"></span></span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-7">
											<button type="submit" name="save" value="save"
												class="btn btn-danger">Save</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-body" style="overflow-x: auto;">>
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>NIK</th>
							<th>Nama</th>
							<th>Username</th>
							<th>JK</th>
							<th>Jabatan</th>
							<th>Departemen</th>
							<th>Sisa Cuti Tahunan</th>
							<th>Sisa Cuti Hamil</th>
							<th>Status</th>
							<th>No. Telp #</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						while ($peg = mysqli_fetch_array($karyawan)) {
							?>
							<tr>
								<td>
									<?php echo $peg['nik']; ?>
								</td>
								<td>
									<?php echo $peg['nama_kry']; ?>
								</td>
								<td>
									<?php echo $peg['username']; ?>
								</td>
								<td>
									<?php echo $peg['jk']; ?>
								</td>
								<td>
									<?php echo $peg['jabatan']; ?>
								</td>
								<td>
									<?php echo $peg['departemen']; ?>
								</td>
								<td>
									<?php echo $peg['hak_cuti_tahunan']; ?>
								</td>
								<td>
									<?php echo $peg['cuti_hamil']; ?>
								</td>
								<td>
									<?php echo $peg['status']; ?>
								</td>
								<td>
									<?php echo $peg['telp']; ?>
								</td>
								<td class="tools">
									<a href="home-admin.php?page=form-lihat-data-karyawan&nik=<?= $peg['nik']; ?>"
										title="view"><i class="fa fa-folder-open"></i></a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="home-admin.php?page=form-edit-data-karyawan&nik=<?= $peg['nik']; ?>"
										title="edit"><i class="fa fa-edit"></i></a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="home-admin.php?page=delete-data-karyawan&nik=<?php echo $peg['nik']; ?>"
										title="delete"><i class="fa fa-trash-o"></i></a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="home-admin.php?page=reset-password&nik=<?php echo $peg['nik']; ?>"
										title="reset pw"><i class="fa fa-undo"></i></a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="home-admin.php?page=reset-cuti&nik=<?php echo $peg['nik']; ?>"
										title="reset cuti"><i class="fa fa-refresh"></i></a>
								</td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	</div>
</section>
<script>
	$(function () {
		$("#example1").DataTable();
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false
		});
	});
</script>
<!-- datepicker -->
<script type="text/javascript" src="plugins/datepicker/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="plugins/datepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="plugins/datepicker/js/locales/bootstrap-datetimepicker.id.js"
	charset="UTF-8"></script>
<script type="text/javascript" src="../../dist/js/pages/form-karyawan.js"></script>
<script type="text/javascript">
	// $(document).ready(function() {
	// 	$('.selectpicker').select2();
	// })

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