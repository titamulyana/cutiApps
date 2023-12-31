<section class="content-header">
  <h1>Approval<small>Cuti</small></h1>
  <ol class="breadcrumb">
    <li><a href="home-karyawan.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Approval Cuti</li>
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
          <br>
          <br>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nama Karyawan</th>
                <th>NIK </th>
                <th>Tgl Pengajuan</th>
                <th>Jumlah Hari</th>
                <th>Keterangan Cuti</th>
                <th>Dari Tanggal</th>
                <th>Sampai Tanggal</th>
                <th>Jenis Cuti</th>
                <th>Status</th>
                <th>Setujui</th>
                <th>Tolak</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include './dist/koneksi.php';
              $nikBawahan = mysqli_query($con, "SELECT nik from tb_users where id_atas='$_SESSION[nik]'");
              $dataArray = array();
              while ($row = mysqli_fetch_assoc($nikBawahan)) {
                $dataArray[] = $row;
              }
              $nikList = "'" . implode("','", array_column($dataArray, 'nik')) . "'";


              $dataCuti = mysqli_query($con, "SELECT * FROM tb_cuti WHERE nik in ($nikList)");
              while ($row = mysqli_fetch_assoc($dataCuti)) {
                $timestamp = strtotime($row['created_at']);
                $date = date("Y-m-d", $timestamp);
                $dep = ($row['depApproval'] === '1') ? 'Disetujui' : (($row['depApproval'] === '0') ? 'Ditolak' : 'Menunggu Persetujuan');

                switch (true) {
                  case ($row['depApproval'] === null):
                    $status = "Menunggu approval atasan";
                    break;
                  case ($row['sdmApproval'] === null):
                    $status = "Menunggu approval HRD";
                    break;
                  case ($row['sdmApproval'] === '1' && $row['depApproval'] === '1'):
                    $status = "Cuti Disetujui";
                    break;
                  case ($row['sdmApproval'] === '0'):
                    $status = "HRD Tidak Menyetujui";
                    break;
                  case ($row['depApproval'] === '0'):
                    $status = "Atasan Tidak Menyetujui";
                    break;
                  default:
                    $status = "Status tidak diketahui";
                    break;
                }

                $sdm = ($row['sdmApproval'] === '1') ? 'Disetujui' : (($row['sdmApproval'] === '0') ? 'Ditolak' : 'Menunggu Persetujuan');
                $nikPemohon = $row['nik'];
                $query = mysqli_query($con, "SELECT nama_kry from tb_users where nik='$nikPemohon'");
                $data = mysqli_fetch_assoc($query)
                  ?>
                <tr>
                  <td>
                    <?= $data['nama_kry'] ?>
                  </td>
                  <td>
                    <?= $row['nik'] ?>
                  </td>
                  <td>
                    <?= $date ?>
                  </td>
                  <td>
                    <?= $row['lama'] ?>
                  </td>
                  <td>
                    <?= $row['alasan'] ?>
                  </td>
                  <td>
                    <?= $row['mulai'] ?>
                  </td>
                  <td>
                    <?= $row['selesai'] ?>
                  </td>
                  <td>
                    <?= $row['jenis_cuti'] ?>
                  </td>
                  <td>
                    <?= $status ?>
                  </td>
                  <td>
                    <form action="home-karyawan.php?page=approval-cuti-karyawan" class="form-horizontal" method="POST"
                      enctype="multipart/form-data">
                      <input type="hidden" value="<?= $row['id'] ?>" name="idcuti">
                      <input type="hidden" value="setujui" name="approval">
                      <button type="submit" name="save" value="save" <?php if ($dep !== 'Menunggu Persetujuan')
                        echo "disabled"; ?> class="btn btn-success"
                        onclick="return confirm('Apakah anda yakin akan menyetujui permohan cuti <?= $data['nama_kry'] ?>?')">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                    </form>
                  </td>
                  <td>
                    <form action="home-karyawan.php?page=approval-cuti-karyawan" class="form-horizontal" method="POST"
                      enctype="multipart/form-data">
                      <input type="hidden" value="<?= $row['id'] ?>" name="idcuti">
                      <input type="hidden" value="tolak" name="approval">
                      <button name="save" value="save" type="submit" <?php if ($dep !== 'Menunggu Persetujuan')
                        echo "disabled"; ?> class="btn btn-danger"
                        onclick="return confirm('Apakah anda yakin akan menolak permohan cuti <?= $data['nama_kry'] ?>')">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                      </button>
                    </form>
                  </td>
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
  document.getElementById('exportButton').addEventListener('click', function () {
    const table = document.getElementById('example1');
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
        newTab.onbeforeunload = function () {
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