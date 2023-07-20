<section class="content-header">
    <h1>Edit<small>Data Jenis Cuti</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Edit Data Jenis Cuti</li>
    </ol>
</section>
<div class="register-box">
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        die("Error. No Kode Selected! ");
    }
    include "dist/koneksi.php";
    if ($_POST['edit'] == "edit") {
        $nama   = $_POST['nama'];
        $deskripsi   = $_POST['deskripsi'];
        $id     = $_GET['id'];
        if (
            empty($_POST['nama']) || empty($_POST['deskripsi'])
        ) {
            echo "<div class='register-logo'><b>Oops!</b> Data Tidak Lengkap.</div>
			<div class='box box-primary'>
				<div class='register-box-body'>
					<p>Harap periksa kembali dan pastikan data yang Anda masukan lengkap dan benar</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-admin.php?page=form-master-jenis-cuti' class='btn btn-block btn-warning'>Back</button>
						</div>
					</div>
				</div>
			</div>";
            die();
        }

        $update = mysqli_query($con, "UPDATE tb_jeniscuti SET nama='$nama', deskripsi='$deskripsi' WHERE id = '$id'");
        if ($update) {
            echo "<div class='register-logo'><b>Edit</b> Successful!</div>	
				<div class='register-box-body'>
					<p>Edit Data Jenis Cuti " . $id . " Berhasil</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-admin.php?page=form-master-jenis-cuti' class='btn btn-primary btn-block btn-flat'>Next >></button>
						</div>
					</div>
				</div>";
        } else {
            echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
        }
    }
    ?>
</div>