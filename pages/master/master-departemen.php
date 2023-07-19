<section class="content-header">
    <h1>Input<small>Data Pegawai</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Input Data Pegawai</li>
    </ol>
</section>
<div class="register-box">
    <?php
    if ($_POST['save'] == "save") {
        $nama = $_POST['nama'];

        include "dist/koneksi.php";

        if (
            empty($_POST['nama'])
        ) {
            echo "<div class='register-logo'><b>Oops!</b> Data Tidak Lengkap.</div>
			<div class='box box-primary'>
				<div class='register-box-body'>
					<p>Harap periksa kembali dan pastikan data yang Anda masukan lengkap dan benar</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-admin.php?page=form-master-departemen' class='btn btn-block btn-warning'>Back</button>
						</div>
					</div>
				</div>
			</div>";
        } else {
            // echo $tgl_lahir; die();
            $insert = "INSERT INTO tb_departemen (nama)
            VALUES ('$nama')";
            $query = mysqli_query($con, $insert);   
            if ($query) {
                echo "<div class='register-logo'><b>Input Data</b> Successful!</div>	
				<div class='register-box-body'>
					<p>Input Data Departemen Berhasil</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-admin.php?page=form-master-departemen' class='btn btn-danger btn-block btn-flat'>Next >></button>
						</div>
					</div>
				</div>";
            } else {
                echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
    ?>
</div>