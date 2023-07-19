<section class="content-header">
  <h1>PROFILE</h1>
  <h1><small>Nomor Induk Pegawai<b> :
        <?= $_SESSION['nik'] ?></b>
    </small></h1>
  <ol class="breadcrumb">
    <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Profile</li>
  </ol>
</section>
<?php
include './dist/koneksi.php';
$ambilData = mysqli_query($con, "SELECT * FROM tb_users WHERE nik='$_SESSION[nik]'");
$hasil = mysqli_fetch_array($ambilData);
// $jmlcut = mysqli_num_rows($tampilCuti);

// $approve=mysqli_query($con,"SELECT * FROM tb_mohoncuti WHERE persetujuan='DISETUJUI' OR persetujuan='TIDAK DISETUJUI'");
// $jmlapprove = mysqli_num_rows($approve);

// $wait=mysqli_query($con,"SELECT * FROM tb_mohoncuti WHERE persetujuan=''");
// $jmlwait = mysqli_num_rows($wait);

// $pegawai=mysqli_query($con,"SELECT * FROM tb_pegawai");
// $jmlpegawai = mysqli_num_rows($pegawai);
?>
<section class="content">
  <div class="panel panel-default" style="background-color: white;border-radius:10px">
    <div class="panel-body">
      <div class="row">
        <div class="col-xs-3">
          <div class="text-black">Nama</a></div>
        </div>
        <div class="col-xs-">
          <div class="text-black"><?= $hasil['nama_peg']; ?></div>
        </div>
      </div>
      <div class="row" style="margin-top: 10px;">
        <div class="col-xs-3">
          Jenis kelamin </div>
        <div class="col-xs-">
          <div class="text-black"><?= $hasil['jk']; ?></div>
        </div>
      </div>
      <div class="row" style="margin-top: 10px;">
        <div class="col-xs-3">
          <div class="text-black">Alamat</a></div>
        </div>
        <div class="col-xs-">
          <div class="text-black"><?= $hasil['alamat']; ?></div>
        </div>
      </div>
      <div class="row" style="margin-top: 10px;">
        <div class="col-xs-3">
          <div class="text-black">No. TLpn</a></div>
        </div>
        <div class="col-xs-">
          <div class="text-black"><?= $hasil['telp']; ?></div>
        </div>
      </div>
      <div class="row" style="margin-top: 10px;">
        <div class="col-xs-3">
          <div class="text-black">Jabatan</a></div>
        </div>
        <div class="col-xs-">
          <div class="text-black"><?= $hasil['jabatan']; ?></div>
        </div>
      </div>
      <div class="row" style="margin-top: 10px;">
        <div class="col-xs-3">
          <div class="text-black">Departemen</a></div>
        </div>
        <div class="col-xs-">
          <div class="text-black"><?= $hasil['departemen']; ?></div>
        </div>
      </div>
      <div class="row" style="margin-top: 10px;">
        <div class="col-xs-3">
          <div class="text-black">Email</a></div>
        </div>
        <div class="col-xs-">
          <div class="text-black"><?= $hasil['email']; ?></div>
        </div>
      </div>
      <div class="row" style="margin-top: 10px;">
        <div class="col-xs-3">
          <div class="text-black">Tanggal Masuk</a></div>
        </div>
        <div class="col-xs-">
          <div class="text-black"><?= $hasil['tgl_masuk']; ?></div>
        </div>
      </div>
      <div class="row" style="margin-top: 10px;">
        <div class="col-xs-3">
          <div class="text-black">Sisa Cuti Tahunan</a></div>
        </div>
        <div class="col-xs-">
          <div class="text-black"><?= $hasil['hak_cuti_tahunan']; ?></div>
        </div>
      </div>
      <?php
      if ($hasil['jk'] == 'perempuan') {
      ?>
        <div class="row" style="margin-top: 10px;">
          <div class="col-xs-3">
            <div class="text-black">Sisa Cuti Hamil</a></div>
          </div>
          <div class="col-xs-">
            <div class="text-black"><?= $hasil['cuti_hamil']; ?></div>
          </div>
        </div>
      <?php

      } ?>

    </div>
  </div>
  <!-- <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body">
          <div class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-3 control-label">Nama</label>
              <div class="col-sm-7">
                <div class="form-control-static"></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Jenis Kelamin</label>
              <div class="col-sm-7">
                <div class="form-control-static"><?= $hasil['jk']; ?></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Jabatan</label>
              <div class="col-sm-7">
                <div class="form-control-static"><?= $hasil['jabatan']; ?></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Tempat, Tanggal Lahir</label>
              <div class="col-sm-7">
                <div class="form-control-static"><?= $hasil['tmpt_lahir']; ?></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Agama</label>
              <div class="col-sm-7">
                <div class="form-control-static"><?= $hasil['agama']; ?></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Status</label>
              <div class="col-sm-7">
                <div class="form-control-static"><?= $hasil['status']; ?></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">No. Telp</label>
              <div class="col-sm-7">
                <div class="form-control-static"><?= $hasil['telp']; ?></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Alamat</label>
              <div class="col-sm-7">
                <div class="form-control-static"><?= $hasil['alamat']; ?></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
</section>