<div class="login-box">
<?php
	include "dist/koneksi.php";
	$nik		= $_POST['nik'];
	$password		= $_POST['password'];
	$op 			= $_GET['op'];

	if($op=="in"){
		$sql = mysqli_query($con,"SELECT * FROM tb_users WHERE nik='$nik' AND password='$password'");
		if(mysqli_num_rows($sql)==1){
			$qry = mysqli_fetch_array($sql);
			$_SESSION['nik'] = $qry['nik'];
			$_SESSION['nama_peg'] = $qry['nama_peg'];
			$_SESSION['hak_akses'] = $qry['hak_akses'];
			
			if($qry['soft_delete']==1){
            echo "<div class='register-logo'><b>Oops!</b> User Tidak Aktif.</div>	
				<div class='register-box-body'>
					<p>Harap tunggu beberapa saat, atau silahkan hubungi Admin Anda.</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='index.php' class='btn btn-block btn-warning'>Back</button>
						</div>
					</div>
				</div>";
			}
			else if($qry['hak_akses']=="hrd"){
				header("location:home-admin.php");
			}
			else if($qry['hak_akses']=="pegawai"){
				header("location:home-pegawai.php");
			}
			else if($qry['hak_akses']=="HRD"){
				header("location:home-hrd.php");
			}
		}
		else{
			echo "<div class='register-logo'><b>Oops!</b> Login Failed.</div>	
				<div class='register-box-body'>
					<p>Email atau Password tidak sesuai. Silahkan diulang kembali.</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='index.php' class='btn btn-block btn-warning'>Back</button>
						</div>
					</div>
				</div>";
		}
	}else if($op=="out"){
		unset($_SESSION['id_user']);
		unset($_SESSION['hak_akses']);
		header("location:index.php");
	}
?>
</div>