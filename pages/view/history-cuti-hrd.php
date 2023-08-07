<section class="content-header">
	<h1>History<small>Cuti</small></h1>
	<ol class="breadcrumb">
		<li><a href="home-karyawan.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li class="active">History Cuti</li>
	</ol>
</section>
<section class="content">

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body" style="overflow-x: auto;">
					<div>
					</div>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No. Cuti</th>
								<th>Tgl Pengajuan</th>
								<th>Jumlah Hari</th>
								<th>Keterangan Cuti</th>
								<th>Dari Tanggal</th>
								<th>Sampai Tanggal</th>
								<th>Jenis Cuti</th>
								<th>Persetujuan Atasan</th>
								<th>Persetujuan HRD</th>
							</tr>
						</thead>
						<tbody>
							<?php
							include './dist/koneksi.php';
							$dataCuti = mysqli_query($con, "SELECT * FROM tb_cuti WHERE nik='$_SESSION[nik]'");
							$no = 1;
							while ($row = mysqli_fetch_assoc($dataCuti)) {
								$timestamp = strtotime($row['created_at']);
								$date = date("Y-m-d", $timestamp);

								$dep = ($row['depApproval'] === '1') ? 'Disetujui' : (($row['depApproval'] === '0') ? 'Ditolak' : 'Menunggu Persetujuan');
								$sdm = ($row['sdmApproval'] === '1') ? 'Disetujui' : (($row['sdmApproval'] === '0') ? 'Ditolak' : 'Menunggu Persetujuan')

							?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $date ?></td>
									<td><?= $row['lama'] ?></td>
									<td><?= $row['alasan'] ?></td>
									<td><?= $row['mulai'] ?></td>
									<td><?= $row['selesai'] ?></td>
									<td><?= $row['jenis_cuti'] ?></td>
									<td><?= $dep ?></td>
									<td><?= $sdm ?></td>
								</tr>
							<?php
							} ?>
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