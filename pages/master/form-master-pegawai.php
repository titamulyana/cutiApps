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
		function kdauto($tabel, $inisial){
		$struktur   = mysqli_query($con,"SELECT * FROM $tabel");
		$field      = mysql_field_name($struktur,0);
		$panjang    = mysql_field_len($struktur,0);
		$qry  = mysqli_query($con,"SELECT max(".$field.") FROM ".$tabel);
		$row  = mysqli_fetch_array($qry);
		if ($row[0]=="") {
		$angka=0;
		}
		else {
		$angka= substr($row[0], strlen($inisial));
		}
		$angka++;
		$angka      =strval($angka);
		$tmp  ="";
		for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";
		}
		return $inisial.$tmp.$angka;
		}
	$tampilPeg=mysqli_query($con,"SELECT * FROM tb_pegawai ORDER BY nip");
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
											<label class="col-sm-3 control-label">NIP</label>
											<div class="col-sm-7">
												<input type="text" name="nip" id="nip" class="form-control" value="<?php echo kdauto("tb_pegawai","PEG-"); ?>" disabled="disabled" />
												<input type="hidden" name="nip" id="nip" value="<?php echo kdauto("tb_pegawai","PEG-"); ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Nama Pegawai</label>
											<div class="col-sm-7">
												<input type="text" name="nama" class="form-control" maxlength="64">
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
												<input type="text" name="jab" class="form-control" maxlength="32">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Tempat, Tanggal Lahir</label>
											<div class="col-sm-3">
												<input type="text" name="tmp_lhr" class="form-control" maxlength="32">
											</div>
											<div class="input-group date form_date col-sm-3" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
												<input type="text" name="tgl_lhr" class="form-control"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Golongan Darah</label>
											<div class="col-sm-7">
												<select name="gol_darah" class="form-control">
													<option value="">Pilih</option>
													<option value="A">A</option>
													<option value="AB">AB</option>
													<option value="B">B</option>
													<option value="O">O</option>
												</select>
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
													<option value="K0">K0</option>
													<option value="K1">K1</option>
													<option value="K2">K2</option>
													<option value="K3">K3</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">No. Telp</label>
											<div class="col-sm-7">
												<input type="text" name="telp" class="form-control" maxlength="12">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Alamat</label>
											<div class="col-sm-7">
												<textarea type="text" name="alamat" class="form-control" maxlength="512"></textarea>
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
								<th>NIP</th>
								<th>Nama</th>
								<th>JK</th>
								<th>Jabatan</th>
								<th>Status</th>
								<th>No. Telp #</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
							while($peg=mysqli_fetch_array($tampilPeg)){
						?>	
							<tr>
								<td><?php echo $peg['nip'];?></td>
								<td><?php echo $peg['nama'];?></td>
								<td><?php echo $peg['jk'];?></td>
								<td><?php echo $peg['jab'];?></td>
								<td><?php echo $peg['status'];?></td>
								<td><?php echo $peg['telp'];?></td>
								<td class="tools"><a href="home-admin.php?page=form-lihat-data-pegawai&nip=<?=$peg['nip'];?>" title="view"><i class="fa fa-folder-open"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="home-admin.php?page=form-edit-data-pegawai&nip=<?=$peg['nip'];?>" title="edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="home-admin.php?page=delete-data-pegawai&nip=<?php echo $peg['nip'];?>" title="delete"><i class="fa fa-trash-o"></i></a></td>
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
<script type="text/javascript" src="plugins/datepicker/js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript">
	 $('.form_date').datetimepicker({
			language:  'id',
			weekStart: 1,
			todayBtn:  1,
	  autoclose: 1,
	  todayHighlight: 1,
	  startView: 2,
	  minView: 2,
	  forceParse: 0
		});
</script>