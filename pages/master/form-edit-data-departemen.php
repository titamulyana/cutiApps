<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
} else {
  die("Error. No Kode Selected! ");
}
include "dist/koneksi.php";
$departemen = mysqli_query($con, "SELECT * from tb_departemen WHERE id='$id'");
$hasil = mysqli_fetch_array($departemen);
$id = $hasil['id'];
?>
<section class="content-header">
  <h1>Form<small>Edit Data departemen </small></h1>
  <ol class="breadcrumb">
    <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Edit Data departemen</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <form action="home-admin.php?page=edit-data-departemen&id=<?= $id ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
          <div class="box-body" style="overflow-x: auto;">
            <div class="form-group">
              <label class="col-sm-3 control-label">Nama Departemen</label>
              <div class="col-sm-7">
                <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $hasil['nama']; ?>" maxlength="50" />
                <!-- <input type="hidden" name="nip" id="nip" value="" /> -->
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-7">
                <button type="submit" name="edit" value="edit" class="btn btn-danger">Save</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- datepicker -->
<script type="text/javascript" src="plugins/datepicker/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="plugins/datepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="plugins/datepicker/js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript">
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