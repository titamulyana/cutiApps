<section class="content-header">
  <h1>Master<small>Data Karyawan Tidak Aktif</small></h1>
  <ol class="breadcrumb">
    <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Data Karyawan Tidak Aktif</li>
  </ol>
</section>
<?php
include "dist/koneksi.php";
//fungsi kode otomatis
$departemen = mysqli_query($con, 'SELECT * from tb_departemen');
$jabatan = mysqli_query($con, 'SELECT * from tb_jabatan');
$atasan = mysqli_query($con, 'SELECT * FROM tb_users WHERE tb_users.hak_akses = "pegawai"');
$pegawai = mysqli_query($con, "SELECT nik, nama_peg, jk, username, jabatan, departemen, status, telp from tb_users WHERE soft_delete = '1'");
?>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body" style="overflow-x: auto;">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Username</th>
                <th>JK</th>
                <th>Jabatan</th>
                <th>Departemen</th>
                <th>Status</th>
                <th>No. Telp #</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($peg = mysqli_fetch_array($pegawai)) {
              ?>
                <tr>
                  <td><?php echo $peg['nik']; ?></td>
                  <td><?php echo $peg['nama_peg']; ?></td>
                  <td><?php echo $peg['username']; ?></td>
                  <td><?php echo $peg['jk']; ?></td>
                  <td><?php echo $peg['jabatan']; ?></td>
                  <td><?php echo $peg['departemen']; ?></td>
                  <td><?php echo $peg['status']; ?></td>
                  <td><?php echo $peg['telp']; ?></td>
                </tr>
              <?php
              }
              ?>
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
<!-- datepicker -->
<script type="text/javascript" src="plugins/datepicker/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="plugins/datepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="plugins/datepicker/js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript" src="../../dist/js/pages/form-pegawai.js"></script>
<script type="text/javascript">
  // $(document).ready(function() {
  // 	$('.selectpicker').select2();
  // })

  $('.form_date').datetimepicker({
    language: 'id',
    weekStart: 1,
    todayBtn: 1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
  });
</script>