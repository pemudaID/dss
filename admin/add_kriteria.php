<?php

if(!isset($_SESSION['LOGIN_username'])){
	exit("<script>location.href='./';</script>");
}
$inisial='';
$nama='';
$atribut='';
$bobot='';
if(isset($_POST['simpan'])){
	$inisial=$_POST['inisial'];
	$nama=$_POST['nama'];
	$atribut=$_POST['atribut'];
	$bobot=$_POST['bobot'];
	
	if(empty($_POST['inisial']) or empty($_POST['nama']) or empty($_POST['atribut']) or empty($_POST['bobot'])){
		echo "<script>window.alert('Kolom bertanda \'harus diisi\' tidak boleh kosong.');</script>";
	}else{
		if($_POST['action']=='new'){
			if(mysqli_num_rows(mysqli_query($con,"select * from kriteria where inisial='".$_POST['inisial']."'"))>0){
				echo "<script>window.alert('Inisial yang anda masukan sudah terdaftar sebelumnya. Silahkan gunakan Inisial yang lain.');</script>";
			}else{

			$q="insert into kriteria(inisial,nama,atribut,bobot) values('".$_POST['inisial']."','".$_POST['nama']."','".$_POST['atribut']."','".$_POST['bobot']."')";
			mysqli_query($con,$q);
		}
	}
		if($_POST['action']=='edit'){

			$q="update kriteria set inisial='".$_POST['inisial']."',nama='".$_POST['nama']."',atribut='".$_POST['atribut']."',bobot='".$_POST['bobot']."' where id_kriteria='".$_POST['id']."'";
			mysqli_query($con,$q);
		}
		exit("<script>location.href='?page=data_kriteria';</script>");
	}
}

$action=$_GET['action'];

if($_GET['action']=='edit' and !empty($_GET['id'])){
	$id=$_GET['id'];
	$q=mysqli_query($con,"select * from kriteria where id_kriteria='".$id."'");
	if(mysqli_num_rows($q)>0){
		$h=mysqli_fetch_array($q);
		$inisial=$h['inisial'];
		$nama=$h['nama'];
		$atribut=$h['atribut'];
		$bobot=$h['bobot'];
	}
}

if($_GET['action']=='delete' and !empty($_GET['id'])){
	$id=$_GET['id'];
	mysqli_query($con,"delete from kriteria where id_kriteria='".$id."'");
	exit("<script>location.href='?page=data_kriteria';</script>");
}

?>
 <div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15">Tambah Data <span class="text-bold">Kriteria & Bobot</span></h5>
									<p>
									Form Tambah Kriteria : 
									</p>
		<form action="" name="" method="post">
		<input name="action" type="hidden" value="<?php echo $action;?>">
		<input name="id" type="hidden" value="<?php echo $id;?>">
		<table width="100%" border="0" cellspacing="4" cellpadding="0" class="tabel_reg">
		   <tr>
		  
			<td width="120">Inisial</td>
			<td><input class="form-control" name="inisial" type="text" size="40" value="<?php echo $inisial;?>"> <em>harus diisi</em></td>
		  </tr>
		  <tr>
			<td width="120">Nama Kriteria</td>
			<td><input class="form-control"name="nama" type="text" size="40" value="<?php echo $nama;?>"> <em>harus diisi</em></td>
		  </tr>
		  <tr>
			<td>Atribut</td>
			<td><select class="cs-select cs-skin-elastic"name="atribut"><option value="benefit"<?php if($atribut=='benefit'){echo ' selected';};?>>Benefit</option><option value="cost"<?php if($atribut=='cost'){echo ' selected';};?>>Cost</option></select> <em>harus diisi</em></td>
		  </tr>
		  <tr>
			<td>Bobot</td>
			<td>
			<select for="form-field-select-2" class="cs-select cs-skin-elastic" name="bobot">
			<option value=""></option>
			<option value="1" <?php if($bobot==1){echo 'selected="selected"';}?>>Sangat Rendah</option>
			<option value="2" <?php if($bobot==2){echo 'selected="selected"';}?>>Rendah</option>
			<option value="3" <?php if($bobot==3){echo 'selected="selected"';}?>>Cukup</option>
			<option value="4" <?php if($bobot==4){echo 'selected="selected"';}?>>Tinggi</option>
			<option value="5" <?php if($bobot==5){echo 'selected="selected"';}?>>Sangat Tinggi</option>
			</select>
			<em>harus diisi</em></td>
		  </tr>
		  <tr>
			<td></td>
			<td><br><input name="simpan" type="submit" value="Simpan" class="btn btn-wide btn-primary pull-left"> 
			<input name="batal" type="button" onClick="location.href='?page=data_kriteria';" value="Batal" class="btn btn-wide btn-red pull-left"></td>
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