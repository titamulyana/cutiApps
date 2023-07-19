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
                <th colspan="2">Action</th>

              </tr>
            </thead>
            <tbody>
              <?php
              include './dist/koneksi.php';
              $dataCuti = mysqli_query($con, "SELECT * FROM tb_cuti WHERE nik='$_SESSION[nik]'");
              while ($row = mysqli_fetch_assoc($dataCuti)) {
                $timestamp = strtotime($row['created_at']);
                $date = date("Y-m-d", $timestamp);

                $dep = ($row['depApproval'] === '1') ? 'Disetujui' : (($row['depApproval'] === '0') ? 'Ditolak' : 'Menunggu Persetujuan');
                $sdm = ($row['sdmApproval'] === '1') ? 'Disetujui' : (($row['sdmApproval'] === '0') ? 'Ditolak' : 'Menunggu Persetujuan')

              ?>
                <tr>
                  <td><?= $row['id'] ?></td>
                  <td><?= $date ?></td>
                  <td><?= $row['lama'] ?></td>
                  <td><?= $row['alasan'] ?></td>
                  <td><?= $row['mulai'] ?></td>
                  <td><?= $row['selesai'] ?></td>
                  <td><?= $row['jenis_cuti'] ?></td>
                  <td style="display: flex;    justify-content: center;">
                    <form action="home-pegawai.php?page=permohonan-cuti-tahunan" class="form-horizontal" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <button type="submit" name="save" value="save" class="btn btn-success">Setujui</button>
                      </div>
                    </form>

                  </td>
                  <td style="display: flex;
    justify-content: center;">

                    <form action="home-pegawai.php?page=permohonan-cuti-tahunan" class="form-horizontal" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <button type="submit" name="save" value="save" class="btn btn-danger">Tolak</button>
                      </div>
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