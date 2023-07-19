<section class="content-header">
    <h1>History<small>Cuti</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-hrd.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">History Cuti</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
			<div class="box box-primary">				
				<div class="box-body">
					<div>
						<p>MAAF, PROSES INI HANYA DAPAT BERJALAN DI APLIKASI VERSI PRO, SILAHKAN HUBUNGI ADMIN RajaPutraMedia.Com</p>
					</div>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No. Cuti</th>
								<th>Tgl Pengajuan</th>
								<th>Jumlah Hari</th>
								<th>Dari Tanggal</th>
								<th>Sampai Tanggal</th>
								<th>Jenis Cuti</th>
								<th>Persetujuan</th>
							</tr>
						</thead>
						<tbody>	
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
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