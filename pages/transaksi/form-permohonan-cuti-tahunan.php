<section class="content-header">
  <h1>Form<small>Cuti</small></h1>
  <ol class="breadcrumb">
    <li><a href="home-pegawai.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Form Pengajuan Cuti</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <form action="home-pegawai.php?page=permohonan-cuti-tahunan" class="form-horizontal" method="POST">
          <div class="box-body">
            <input type="hidden" value="<?= $_SESSION['nik'] ?>" name="nik">
            <div class="form-group">
              <label class="col-sm-3 control-label">Dari Tanggal</label>
              <div class="col-sm-4">
                <div class="input-group date form_date col-sm-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                  <input required type="text" name="mulai" class="form-control"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Sampai Tanggal</label>
              <div class="col-sm-4">
                <div class="input-group date form_date col-sm-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                  <input required type="text" name="selesai" class="form-control"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
              </div>
            </div>
            <div class="form-group has-feedback">
              <label class="col-sm-3 control-label">Jenis Cuti</label>
              <div class="col-sm-4">
                <select name="jenis" class="form-control" required>
                  <?php
                  include './dist/koneksi.php';
                  $tampilCuti = mysqli_query($con, "SELECT * FROM tb_jeniscuti");
                  while ($row = mysqli_fetch_assoc($tampilCuti)) {
                    $nama = $row['nama'];
                    $namaUppercase = ucfirst($nama);
                  ?>
                    <option value="<?= $row['nama'] ?>"><?= $namaUppercase ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group has-feedback">
              <label class="col-sm-3 control-label">Alasan </label>
              <div class="col-sm-4">
                <textarea required id="alasan" name="alasan" rows="4" class="form-control w-100"></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-7">
                <button type="submit" name="save" value="save" class="btn btn-primary">Kirim</button>
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