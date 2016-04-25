<?php
  
if(!isset($_SESSION['LOGIN_username'])){
	exit("<script>location.href='./';</script>");
}
$nama='';
$nilai='';

if(isset($_POST['simpan'])){
	$nama=$_POST['nama'];
	$nilai=$_POST['nilai'];
	if(empty($_POST['nama'])){
		echo "<script>window.alert('Kolom bertanda \'harus diisi\' tidak boleh kosong.');</script>";
	}else{
		if($_POST['action']=='new'){
			$q="insert into himpunan(id_kriteria, nama, nilai) values('".$_POST['id2']."', '".$_POST['nama']."', '".$_POST['nilai']."')";
			mysqli_query($con,$q);
			$id2=$_POST['id2'];
		}
		if($_POST['action']=='edit'){
			$q="update himpunan set nama='".$_POST['nama']."',nilai='".$_POST['nilai']."' where id_himpunan='".$_POST['id']."'";
			mysqli_query($con,$q);
			$id2=$_POST['id2'];
		}
		exit("<script>location.href='?page=data_himpunan&kriteria=".$id2."';</script>");
	}
}
$id2='';
if(isset($_GET['id2'])){
	$id2=$_GET['id2'];
}
$q=mysqli_query($con,"select * from kriteria where id_kriteria='".$id2."'");
if(mysqli_num_rows($q)>0){
	$h=mysqli_fetch_array($q);
	$kriteria=$h['nama'];
}

$action=$_GET['action'];
if($_GET['action']=='edit' and !empty($_GET['id'])){
	$id=$_GET['id'];
	$q=mysqli_query($con,"select * from himpunan where id_himpunan='".$id."'");
	if(mysqli_num_rows($q)>0){
		$h=mysqli_fetch_array($q);
		$nama=$h['nama'];
		$nilai=$h['nilai'];
		$id2=$h['id_kriteria'];
		$q=mysqli_query($con,"select * from kriteria where id_kriteria='".$h['id_kriteria']."'");
		if(mysqli_num_rows($q)>0){
			$h=mysqli_fetch_array($q);
			$kriteria=$h['nama'];
		}
	}
}
if($_GET['action']=='delete' and !empty($_GET['id'])){
	$id=$_GET['id'];
	$id2=$_GET['id2'];
	mysqli_query($con,"delete from himpunan where id_himpunan='".$id."'");
	exit("<script>location.href='?page=data_himpunan&kriteria=".$id2."';</script>");
}

?>

 <div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15">Tambah Data <span class="text-bold">Nilai Crips</span></h5>
									<p>
									
									</p>
                <div class="box-body">
		<form action="" name="" method="post">
		<input name="action" type="hidden" value="<?php echo $action;?>">
		<input name="id" type="hidden" value="<?php echo $id;?>">
		<input name="id2" type="hidden" value="<?php echo $id2;?>">
		<table width="50%" border="0" cellspacing="4" cellpadding="0" class="tabel_reg">
		  <tr>
			<td width="120">Nama Kriteria</td>
			<td><strong><?php echo $kriteria;?></strong></td>
		  </tr>
		  <tr>
			<td>Nama Himpunan</td>
			<td><input class="form-control" name="nama" type="text" size="40" value="<?php echo $nama;?>"> <em>harus diisi</em></td>
		  </tr>
		  <tr>
			<td>Nilai</td>
			<td><input class="form-control" name="nilai" type="text" size="10" value="<?php echo $nilai;?>"> </td>
		  </tr>
		  <tr>
			<td></td>
			<td> <br><input name="simpan" class="btn btn-wide btn-primary pull-left" type="submit" value="Simpan" > <a>    </a><input name="batal" type="button" onClick="location.href='?page=data_himpunan&kriteria=<?php echo $id2;?>';" class="btn btn-wide btn-red pull-left" value="Batal"></td>
		  </tr>
		</table>
		</form>


    	</div>
<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>