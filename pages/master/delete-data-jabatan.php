<section class="content-header">
    <h1>Delete<small>Data Jabatan</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Delete Data Jabatan</li>
    </ol>
</section>
<div class="register-box">
    <?php
    include "dist/koneksi.php";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query   = "SELECT * FROM tb_jabatan WHERE id='$id'";
        $hasil   = mysqli_query($con, $query);
        $data    = mysqli_fetch_array($hasil);
    } else {
        die("Error. No Kode Selected! ");
    }

    if (!empty($id) && $id != "") {
        $delete = "DELETE FROM tb_departemen WHERE id='$id'";
        $sqldel = mysqli_query($con, $delete);

        if ($sqldel) {
            echo "<div class='register-logo'><b>Delete</b> Successful!</div>	
				<div class='register-box-body'>
					<p>Data Jabatan " . $id . " Berhasil di Hapus</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-admin.php?page=form-master-jabatan' class='btn btn-primary btn-block btn-flat'>Next >></button>
						</div>
					</div>
                </div>";
        } else {
            echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
        }
    }
    mysqli_close($con);
    ?>
</div>