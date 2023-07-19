<section class="content-header">
  <h1>Approval<small>Cuti</small></h1>
  <ol class="breadcrumb">
    <li><a href="home-pegawai.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">History Cuti</li>
  </ol>
</section>
<section class="content">
  <!-- <div class='register-logo'><b>Approval</b> Cuti!</div> -->
  <!-- <div class='register-box-body'>
    <p>Silahkan tentukan status persetujuan untuk permohonan cuti No. <b>$no_cuti</b></p>
    <div class='row'>
      <div class='col-xs-1'></div>
      <div class='col-xs-5'>
        <div class='box-body box-profile'>
          <a class='btn btn-primary btn-block' href='home-hrd.php?page=approved-cuti'>Approved</a>
        </div>
      </div>
      <div class='col-xs-5'>
        <div class='box-body box-profile'>
          <a class='btn btn-warning btn-block' href='home-hrd.php?page=not-approved-cuti'>Not Approved</a>
        </div>
      </div>
      <div class='col-xs-1'></div>
    </div>
  </div> -->
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body" style="overflow-x: auto;">
          <div>
          </div>
          <table id="example2" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nama Pegawai</th>
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
                $sdm = ($row['sdmApproval'] === '1') ? 'Disetujui' : (($row['sdmApproval'] === '0') ? 'Ditolak' : 'Menunggu Persetujuan');
                $nikPemohon = $row['nik'];
                $query = mysqli_query($con, "SELECT nama_peg from tb_users where nik='$nikPemohon'");
                $data = mysqli_fetch_assoc($query)
              ?>
                <tr>
                  <td><?= $data['nama_peg'] ?></td>
                  <td><?= $date ?></td>
                  <td><?= $row['lama'] ?></td>
                  <td><?= $row['alasan'] ?></td>
                  <td><?= $row['mulai'] ?></td>
                  <td><?= $row['selesai'] ?></td>
                  <td><?= $row['jenis_cuti'] ?></td>
                  <td><?= $dep ?></td>
                  <td>
                    <form action="home-pegawai.php?page=approval-cuti-pegawai" class="form-horizontal" method="POST" enctype="multipart/form-data">
                      <input type="hidden" value="<?= $row['id'] ?>" name="idcuti">
                      <input type="hidden" value="setujui" name="approval">
                      <button type="submit" name="save" value="save" <?php if ($dep !== 'Menunggu Persetujuan') echo "disabled"; ?> class="btn btn-success" onclick="return confirm('Apakah anda yakin akan menyetujui permohan cuti <?= $data['nama_peg'] ?>?')">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>

                    </form>
                  </td>
                  <td>
                    <form action="home-pegawai.php?page=approval-cuti-pegawai" class="form-horizontal" method="POST" enctype="multipart/form-data">
                      <input type="hidden" value="<?= $row['id'] ?>" name="idcuti">
                      <input type="hidden" value="tolak" name="approval">
                      <button name="save" value="save" type="submit" <?php if ($dep !== 'Menunggu Persetujuan') echo "disabled"; ?> class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menolak permohan cuti <?= $data['nama_peg'] ?>')">
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
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>