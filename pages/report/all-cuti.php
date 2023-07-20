<section class="content-header">
	<h1>Approval<small>Cuti</small></h1>
	<ol class="breadcrumb">
		<li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li class="active">Report Cuti</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body" style="overflow-x: auto;">
					<div>
					</div>
					<button id="exportButton" class="btn btn-primary">Export to PDF</button>
					<table id="example2" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Tgl Pengajuan</th>
								<th>Nama Pegawai</th>
								<th>Jenis Cuti</th>
								<th>Jumlah Hari</th>
								<th>Keterangan Cuti</th>
								<th>Dari Tanggal</th>
								<th>Sampai Tanggal</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
							include './dist/koneksi.php';

							$dataCuti = mysqli_query($con, "SELECT * FROM tb_cuti");
							while ($row = mysqli_fetch_assoc($dataCuti)) {
								$timestamp = strtotime($row['created_at']);
								$date = date("Y-m-d", $timestamp);
								$dep = ($row['depApproval'] === '1') ? 'Disetujui' : (($row['depApproval'] === '0') ? 'Ditolak' : 'Menunggu Persetujuan');
								$sdm = ($row['sdmApproval'] === '1') ? 'Disetujui' : (($row['sdmApproval'] === '0') ? 'Ditolak' : 'Menunggu Persetujuan');
								$nikPemohon = $row['nik'];
								$query = mysqli_query($con, "SELECT nama_peg from tb_users where nik='$nikPemohon'");
								$data = mysqli_fetch_assoc($query)
							?>
								<tr>
                                    <td><?= $date ?></td>
									<td><?= $data['nama_peg'] ?></td>
									<td><?= $row['jenis_cuti'] ?></td>
									<td><?= $row['lama'] ?> Hari</td>
									<td><?= $row['alasan'] ?></td>
									<td><?= $row['mulai'] ?></td>
									<td><?= $row['selesai'] ?></td>
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
	document.getElementById('exportButton').addEventListener('click', function() {
		const table = document.getElementById('example2');
		const tableHTML = table.outerHTML;

		// Kirim data tabel ke server untuk konversi ke PDF
		fetch('export-pdf.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				body: 'tableHTML=' + encodeURIComponent(tableHTML)
			})
			.then(response => response.blob())
			.then(blob => {
				// Buat objek URL untuk hasil blob PDF
				const pdfUrl = URL.createObjectURL(blob);

				// Buka PDF di tab baru atau tampilkan opsi unduh
				const newTab = window.open(pdfUrl, '_blank');
				// newTab.location.href = pdfUrl; // Opsional: Buka PDF di tab yang sama

				// Hapus objek URL setelah PDF ditutup atau diunduh
				newTab.onbeforeunload = function() {
					URL.revokeObjectURL(pdfUrl);
				};
			})
			.catch(error => {
				console.error('Error:', error);
			});
	});

	function confirmSubmit() {
		// Munculkan konfirmasi menggunakan fungsi confirm()
		var result = confirm('Apakah Anda yakin ingin menyubmit form?');

		// Jika pengguna mengklik "OK", return true agar form dikirimkan
		// Jika pengguna mengklik "Cancel", return false agar form tidak dikirimkan
		return result;
	}
	$(function() {
		$("#example1").DataTable();
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false
		});
	});
</script>