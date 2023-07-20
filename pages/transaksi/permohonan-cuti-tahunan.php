<section class="content-header">
  <h1>Permohonan<small>Cuti</small></h1>
  <ol class="breadcrumb">
    <li><a href="home-pegawai.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Permohonan Cuti</li>
  </ol>
</section>
<div class="register-box">
  <?php
  include "dist/koneksi.php";
  // function kdauto($tabel, $inisial){
  // 	$struktur   = mysqli_query($con,"SELECT * FROM $tabel");
  // 	$field      = mysql_field_name($struktur,0);
  // 	$panjang    = mysql_field_len($struktur,0);
  // 	$qry  = mysqli_query($con,"SELECT max(".$field.") FROM ".$tabel);
  // 	$row  = mysqli_fetch_array($qry);
  // 	if ($row[0]=="") {
  // 	$angka=0;
  // 	}
  // 	else {
  // 	$angka= substr($row[0], strlen($inisial));
  // 	}
  // 	$angka++;
  // 	$angka      =strval($angka);
  // 	$tmp  ="";
  // 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
  // 	$tmp=$tmp."0";
  // 	}
  // 	return $inisial.$tmp.$angka;
  // }





  $tgl    = date('H:m:s');


  if ($_POST['save'] == "save") {

    // data tidak boleh kosong
    if (empty($_POST['mulai']) || empty($_POST['selesai']) || empty($_POST['alasan'] || empty($_POST['jenis']))) {
      echo "<div class='register-logo'><b>Oops!</b> Data Tidak Lengkap.</div>
			<div class='box box-primary'>
				<div class='register-box-body'>
					<p>Harap periksa kembali dan pastikan data yang Anda masukan lengkap dan benar</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-pegawai.php?page=form-permohonan-cuti-tahunan' class='btn btn-block btn-warning'>Back</button>
						</div>
					</div>
				</div>
			</div>";
      exit();
    }
    $nik = htmlspecialchars($_POST['nik']);
    $mulai  = htmlspecialchars($_POST['mulai']);
    $currentDate = strtotime(date('Y-m-d'));
    $mulaiTimestamp = strtotime($mulai);

    // tanggal pengajuan harus maksimal h-1 sebelum cuti
    if ($mulaiTimestamp <= $currentDate) {
      echo "<div class='register-logo'>Tanggal Cuti Tidak Sesuai.<b></div>
			<div class='box box-primary'>
				<div class='register-box-body'>
					<p>Pengajuan Cuti maksimal h-1 sebelum tanggal pengajuan cuti</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-pegawai.php?page=form-permohonan-cuti-tahunan' class='btn btn-block btn-warning'>Back</button>
						</div>
					</div>
				</div>
			</div>";
      exit();
    }

    $selesai  = $_POST['selesai'];
    $jenis = ($_POST['jenis'] === 'tahunan') ? 'hak_cuti_tahunan' : 'cuti_hamil';
    $alasan = $_POST['alasan'];

    // check tanggal selesai tidak boleh sebelum tanggal mulai  ( tanngal_selesai < tanggal_mulai )
    if ($selesai < $mulai) {
      echo "<div class='register-logo'><b>Tanggal Cuti Tidak Sesuai.</div>
			<div class='box box-primary'>
				<div class='register-box-body'>
					<p>Harap periksa kembali, tanggal mulai dan selesai tidak sesuai</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-pegawai.php?page=form-permohonan-cuti-tahunan' class='btn btn-block btn-warning'>Back</button>
						</div>
					</div>
				</div>
			</div>";
      exit();
    }

    //menghitung jumlah hari
    $selisih = strtotime($selesai) - strtotime($mulai);
    $selisih = $selisih / 86400;
    $jml_hari = 1 + $selisih;

    if ($jenis == 'tahunan') {
    }
    $query = mysqli_query($con, "SELECT $jenis FROM tb_users WHERE nik='$nik'");
    $data = mysqli_fetch_array($query);
    $hak = $data[$jenis];

    // check sisa cuti tidak boleh lebih kecil dari jumlah pengajuan cuti
    if ($hak < $jml_hari) {
      echo "<div class='register-logo'><b>Jatah Cuti Tidak Sesuai.</div>
			<div class='box box-primary'>
				<div class='register-box-body'>
					<p>Permintaan Cuti Anda tidak sesuai , anda memiliki sisa cuti $hak , sedangkan permohonan cuti untuk $jml_hari hari</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-pegawai.php?page=form-permohonan-cuti-tahunan' class='btn btn-block btn-warning'>Back</button>
						</div>
					</div>
				</div>
			</div>";
      exit();
    }

    try {
      $queryCuti = "INSERT INTO tb_cuti (nik, jenis_cuti, mulai, selesai, lama, alasan)
      VALUES ('$nik', '$jenis', '$mulai', '$selesai', '$jml_hari', '$alasan')";
      $updateCuti = mysqli_query($con, $queryCuti);
      if  (mysqli_affected_rows($con) > 0) {
        echo "<div class='register-logo'><b>Permohon Cuti Berhasil Diajukan</div>
			<div class='box box-primary'>
				<div class='register-box-body'>
					<p>Menunggu Persetujuan!!</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-pegawai.php' class='btn btn-block btn-warning'>Done</button>
						</div>
					</div>
				</div>
			</div>";
      } else {
        echo "<div class='register-logo'><b>Terjadi Kesalahan , silahkan ajukan ulang!</div>
			<div class='box box-primary'>
				<div class='register-box-body'>
					<p>Update failed:" . mysqli_error($con) . "</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-pegawai.php?page=form-permohonan-cuti-tahunan' class='btn btn-block btn-warning'>back</button>
						</div>
					</div>
				</div>
			</div>";
      }
    } catch (Exception $e) {
      echo "<div class='register-logo'><b>Terjadi Kesalahan , silahkan ajukan ulang!</div>
			<div class='box box-primary'>
				<div class='register-box-body'>
					<p>Update failed:" . $e->getMessage(). "</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-pegawai.php?page=form-permohonan-cuti-tahunan' class='btn btn-block btn-warning'>back</button>
						</div>
					</div>
				</div>
			</div>";
    }



  }
  ?>
</div>