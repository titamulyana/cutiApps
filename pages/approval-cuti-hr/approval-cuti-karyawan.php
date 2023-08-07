<section class="content-header">
  <h1>Approval<small>Cuti</small></h1>
  <ol class="breadcrumb">
    <li><a href="home-karyawan.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Approval Cuti</li>
  </ol>
</section>
<div class="register-box">
  <?php
  include "dist/koneksi.php";

  if ($_POST['save'] == "save") {

    // data tidak boleh kosong
    if (empty($_POST['idcuti']) || empty($_POST['approval'])) {
      echo "<div class='register-logo'><b>Oops!</b>Oops ! Terjadi Kesalahan.</div>
			<div class='box box-primary'>
				<div class='register-box-body'>
					<p>Harap periksa kembali dan pastikan data yang Anda masukan lengkap dan benar</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-admin.php?page=approval-cuti' class='btn btn-block btn-warning'>Back</button>
						</div>
					</div>
				</div>
			</div>";
      exit();
    }
    $idcuti = $_POST['idcuti'];
    $approval = ($_POST['approval'] === 'setujui') ? 1 : 0;
    $msg = ($_POST['approval'] === 'setujui') ? 'Disetujui' : 'Ditolak';
    $jeniscuti = $_POST['jeniscuti'];
    $lama = $_POST['lama'];
    $nik = $_POST['nik'];

    try {
      // mencoba mengupdate tb_cuti
      $editApproval = mysqli_query($con, "UPDATE tb_cuti SET sdmApproval='$approval', sdmApproval_at=now()  WHERE id='$idcuti'");
      $updateCuti = mysqli_query($con, "UPDATE tb_users SET $jeniscuti= $jeniscuti - $lama WHERE nik='$nik'");
      if ($editApproval && mysqli_affected_rows($con) > 0) {
        echo "<div class='register-logo'><b>Cuti $msg </div>
            <div class='box box-primary'>
              <div class='register-box-body'>
                <div class='row'>
                  <div class='col-xs-8'></div>
                  <div class='col-xs-4'>
                    <button type='button' onclick=location.href='home-admin.php?page=approval-cuti' class='btn btn-block btn-warning'>Terima Kasih</button>
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
                      <button type='button' onclick=location.href='home-admin.php?page=approval-cuti' class='btn btn-block btn-warning'>back</button>
                    </div>
                  </div>
                </div>
              </div>";
      }
    } catch (Exception $e) {
      echo "<div class='register-logo'><b>Terjadi Kesalahan!!!</div>
			<div class='box box-primary'>
				<div class='register-box-body'>
					<p>Update failed:" . $e->getMessage() . "</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-admin.php?page=approval-cuti' class='btn btn-block btn-warning'>back</button>
						</div>
					</div>
				</div>
			</div>";
      exit();
    }
  }
  ?>
</div>