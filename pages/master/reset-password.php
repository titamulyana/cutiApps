<section class="content-header">
    <h1>Resset<small>Password Karyawan</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Reset Password Karyawan</li>
    </ol>
</section>
<div class="register-box">
    <?php
    include "dist/koneksi.php";
    if (isset($_GET['nik'])) {
        $nik = $_GET['nik'];
        $query = "SELECT * FROM tb_users WHERE nik='$nik'";
        $hasil = mysqli_query($con, $query);
        $data = mysqli_fetch_array($hasil);
    } else {
        die("Error. No Kode Selected! ");
    }

    if (!empty($nik) && $nik != "") {
        $delete = "UPDATE tb_users SET password='123' WHERE nik='$nik'";
        $sqldel = mysqli_query($con, $delete);

        if ($sqldel) {
            echo "<div class='register-logo'><b>reset password</b> Successful!</div>	
				<div class='register-box-body'>
					<p>Password data Karyawan " . $data['nama_kry'] . " Berhasil di reset</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-admin.php?page=form-master-karyawan' class='btn btn-primary btn-block btn-flat'>Next >></button>
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