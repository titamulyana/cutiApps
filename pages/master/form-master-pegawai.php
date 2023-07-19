<section class="content-header">
	<h1>Master<small>Data Pegawai</small></h1>
	<ol class="breadcrumb">
		<li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li class="active">Data Pegawai</li>
	</ol>
</section>
<?php
include "dist/koneksi.php";
//fungsi kode otomatis
$departemen = mysqli_query($con, 'SELECT * from tb_departemen');
$jabatan = mysqli_query($con, 'SELECT * from tb_jabatan');
$atasan = mysqli_query($con, 'SELECT * FROM tb_users WHERE tb_users.hak_akses = "pegawai"');
$pegawai = mysqli_query($con, "SELECT nik, nama_peg, jk, username, jabatan, departemen, status, telp from tb_users WHERE soft_delete = '0'");
?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body">
					<div class="panel-group">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title"><i class="fa fa-plus"></i> Add Data Pegawai<a data-toggle="collapse" data-target="#formpegawai" href="#formpegawai" class="collapsed"></a></h4>
							</div>
							<div id="formpegawai" class="panel-collapse collapse">
								<div class="panel-body">
									<form action="home-admin.php?page=master-pegawai" class="form-horizontal" method="POST" enctype="multipart/form-data">
										<div class="form-group">
											<label class="col-sm-3 control-label">NIK</label>
											<div class="col-sm-7">
												<input type="text" name="nik" id="nik" class="form-control" value="" />
												<!-- <input type="hidden" name="nip" id="nip" value="" /> -->
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Nama Pegawai</label>
											<div class="col-sm-7">
												<input type="text" name="nama_peg" class="form-control" maxlength="64">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Username</label>
											<div class="col-sm-7">
												<input type="text" name="username" class="form-control" maxlength="64">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Jenis Kelamin</label>
											<div class="col-sm-7">
												<select name="jk" class="form-control">
													<option value="">Pilih</option>
													<option value="L">Laki-laki</option>
													<option value="P">Perempuan</option>
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
														<option value="<?php echo $row['nama'] ?>"><?php echo $row['nama'] ?></option>
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
													<option value="hrd">HRD</option>
													<option value="pegawai">Pegawai</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Tempat, Tanggal Lahir</label>
											<div class="col-sm-3">
												<input type="text" name="tmpt_lahir" class="form-control" maxlength="32">
											</div>
											<div class="input-group date form_date col-sm-3" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
												<input type="text" name="tgl_lahir" class="form-control"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Agama</label>
											<div class="col-sm-7">
												<select name="agama" class="form-control">
													<option value="">Pilih</option>
													<option value="Islam">Islam</option>
													<option value="Protestan">Protestan</option>
													<option value="Katolik">Katolik</option>
													<option value="Hindu">Hindu</option>
													<option value="Budha">Budha</option>
													<option value="Kepercayaan">Kepercayaan</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Status</label>
											<div class="col-sm-7">
												<select name="status" class="form-control">
													<option value="">Pilih</option>
													<option value="single">Single</option>
													<option value="married">Married</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">No. Telp</label>
											<div class="col-sm-7">
												<input type="text" name="telp" class="form-control" maxlength="13">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Email</label>
											<div class="col-sm-7">
												<input type="email" name="email" class="form-control">
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
														<option value="<?php echo $row['nama'] ?>"><?php echo $row['nama'] ?></option>
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
														<option value="<?php echo $row['nik'] ?>"><?php echo $row['nama_peg'] ?></option>
													<?php
													}
													?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Alamat</label>
											<div class="col-sm-7">
												<textarea type="text" name="alamat" class="form-control" maxlength="512"></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Hak Cuti Tahunan</label>
											<div class="col-sm-7">
												<input type="number" name="hak_cuti_tahunan" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Cuti Hamil</label>
											<div class="col-sm-7">
												<input type="number" name="cuti_hamil" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Tanggal Masuk</label>
											<div class="col-sm-7">
												<div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
													<input type="text" name="tgl_masuk" class="form-control"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-3 col-sm-7">
												<button type="submit" name="save" value="save" class="btn btn-danger">Save</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>NIK</th>
								<th>Nama</th>
								<th>Username</th>
								<th>JK</th>
								<th>Jabatan</th>
								<th>Departemen</th>
								<th>Status</th>
								<th>No. Telp #</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($peg = mysqli_fetch_array($pegawai)) {
							?>
								<tr>
									<td><?php echo $peg['nik']; ?></td>
									<td><?php echo $peg['nama_peg']; ?></td>
									<td><?php echo $peg['username']; ?></td>
									<td><?php echo $peg['jk']; ?></td>
									<td><?php echo $peg['jabatan']; ?></td>
									<td><?php echo $peg['departemen']; ?></td>
									<td><?php echo $peg['status']; ?></td>
									<td><?php echo $peg['telp']; ?></td>
									<td class="tools"><a href="home-admin.php?page=form-lihat-data-pegawai&nik=<?= $peg['nik']; ?>" title="view"><i class="fa fa-folder-open"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="home-admin.php?page=form-edit-data-pegawai&nik=<?= $peg['nik']; ?>" title="edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="home-admin.php?page=delete-data-pegawai&nik=<?php echo $peg['nik']; ?>" title="delete"><i class="fa fa-trash-o"></i></a></td>
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
	$(function() {
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
<script type="text/javascript" src="plugins/datepicker/js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
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