<section class="content-header">
    <h1>Master<small>Data Jenis Cuti</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Data Jenis Cuti</li>
    </ol>
</section>
<?php
include "dist/koneksi.php";
//fungsi kode otomatis
$jenis_cuti = mysqli_query($con, 'SELECT * from tb_jeniscuti');
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><i class="fa fa-plus"></i> Add Data Jenis Cuti<a data-toggle="collapse" data-target="#formkaryawan" href="#formkaryawan" class="collapsed"></a></h4>
                            </div>
                            <div id="formkaryawan" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <form action="home-admin.php?page=master-jenis-cuti" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Jenis Cuti</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="nama" id="nama" class="form-control" value="" maxlength="50" />
                                                <!-- <input type="hidden" name="nip" id="nip" value="" /> -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Deskripsi</label>
                                            <div class="col-sm-7">
                                                <textarea type="text" name="deskripsi" class="form-control" maxlength="512"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-7">
                                                <button type="submit" name="save" value="save" class="btn btn-danger">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Jenis Cuti</th>
                                <th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($jenis_cuti)) {
                            ?>
                                <tr>
                                    <td><strong><?php echo $row['nama']; ?></strong></td>
                                    <td><strong><?php echo $row['deskripsi']; ?></strong></td>
                                    <td class="tools"><a href="home-admin.php?page=form-edit-data-jenis-cuti&id=<?= $row['id']; ?>" title="edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="home-admin.php?page=delete-data-jenis-cuti&id=<?php echo $row['id']; ?>" title="delete"><i class="fa fa-trash-o"></i></a></td>
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