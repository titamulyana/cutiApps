<section class="content-header">
	<h1>cuti Online<small>Dashboard</small></h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	</ol>
</section>
<?php
include "dist/koneksi.php";
$cuti = mysqli_query($con, "SELECT * FROM tb_cuti");
$jmlcuti = mysqli_num_rows($cuti);

$approve = mysqli_query($con, "SELECT * FROM tb_cuti WHERE sdmApproval='1' AND depApproval='1'");
$jmlapprove = mysqli_num_rows($approve);

$wait = mysqli_query($con, "SELECT * FROM tb_cuti WHERE sdmApproval IS NULL OR depApproval IS NULL");
$jmlwait = mysqli_num_rows($wait);

$pegawai = mysqli_query($con, "SELECT * FROM tb_users");
$jmlpegawai = mysqli_num_rows($pegawai);
?>
<section class="content">
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3><?php echo $jmlcuti; ?></h3>
					<p>Total Cuti</p>
				</div>
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
				<p class="small-box-footer">Cuti <i class="fa fa-arrow-circle-right"></i></p>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-green">
				<div class="inner">
					<h3><?php echo $jmlapprove; ?></h3>
					<p>Total Approve</p>
				</div>
				<div class="icon">
					<i class="ion ion-person"></i>
				</div>
				<p class="small-box-footer">Approval <i class="fa fa-arrow-circle-right"></i></p>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3><?php echo $jmlwait; ?></h3>
					<p>Total Waiting</p>
				</div>
				<div class="icon">
					<i class="ion ion-person"></i>
				</div>
				<p class="small-box-footer">Approval <i class="fa fa-arrow-circle-right"></i></p>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-red">
				<div class="inner">
					<h3><?php echo $jmlpegawai; ?></h3>
					<p>Total Pegawai</p>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
				<p class="small-box-footer">Pegawai <i class="fa fa-arrow-circle-right"></i></p>
			</div>
		</div>
	</div>
</section>