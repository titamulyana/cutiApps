<section class="content-header">
  <h1>Scan Cuti<small>Karyawan</small></h1>
  <ol class="breadcrumb">
    <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Scan Cuti Karyawan</li>
  </ol>
</section>
<div class="register-box">
  <?php
  include "dist/koneksi.php";
  if (isset($_GET['nik'])) {
    $nik = $_GET['nik'];
    $query   = "SELECT * FROM tb_users WHERE nik='$nik'";
    $hasil   = mysqli_query($con, $query);
    $data    = mysqli_fetch_array($hasil);
  } else {
    die("Error. No Kode Selected! ");
  }

  if (!empty($nik) && $nik != "") {
    $scan = "SELECT hak_cuti_tahunan, tgl_masuk FROM tb_users WHERE nik='$nik'";
    $scanQ = mysqli_query($con, $scan);
    $hasilQ = mysqli_fetch_array($scanQ);

    $tgl_masuk = strtotime($hasilQ['tgl_masuk']);
    $tgl_masuk_formatted = date('Y-m-d', $tgl_masuk);
    $tahun_berikutnya = date('Y-m-d', strtotime($tgl_masuk_formatted . ' +1 year'));

    $today = date('Y-m-d');
    $firstDayOfYear = date('Y-01-01');

    if ($today === $firstDayOfYear || $today >= $tahun_berikutnya) {
      $updateCuti = "UPDATE tb_users SET hak_cuti_tahunan=12 WHERE nik='$nik'";
      $sqldel = mysqli_query($con, $updateCuti);

      echo "<div class='register-logo'><b>scan cuti</b> Successful!</div>
				<div class='register-box-body'>
					<p>Cuti " . $data['nama_peg'] . " Berhasil di update</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-admin.php?page=form-master-pegawai' class='btn btn-primary btn-block btn-flat'>Next >></button>
						</div>
					</div>
                </div>";
      exit();
    }
    echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>
            <div class='col-xs-4'>
            <button type='button' onclick=location.href='home-admin.php?page=form-master-pegawai' class='btn btn-primary btn-block btn-flat'>Next >></button>
          </div>";
  }
  mysqli_close($con);
  ?>
</div>