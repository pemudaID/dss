<?php
  
if(empty($_SESSION['LOGIN_username'])){
	exit("<script>location.href='./';</script>");
}
$nim='';
$nama='';
$mapel='';
$Alamat='';
$himpunan=array();
$kriteria=array();
$q=mysqli_query($con,"select * from kriteria");
while($h=mysqli_fetch_array($q)){
	$kriteria[]=array($h['id_kriteria'],$h['nama']);
}

if(isset($_POST['simpan'])){
	$nim=$_POST['nim'];
	$nama=$_POST['nama'];
	
	$isi=true;
	for($i=0;$i<count($kriteria);$i++){
		$himpunan[]=$_POST['kriteria_'.$kriteria[$i][0]];
		if(empty($_POST['kriteria_'.$kriteria[$i][0]])){
			$isi=false;
		}
	}
	
		if($_POST['action']=='edit'){
			$q=mysqli_query($con,"select nim from alternatif where id_alternatif='".$_POST['id']."'");
			$h=mysqli_fetch_array($q);
			$nim_tmp=$h['nim'];
			if(mysqli_num_rows(mysqli_query($con,"select * from alternatif where nim='".$_POST['nim']."' and nim<>'".$nim_tmp."'"))>0){
				echo "<script>window.alert('NIM yang anda masukan sudah terdaftar sebelumnya. Silahkan gunakan NIM yang lain.');</script>";
			}else{
				$q="update alternatif set nim='".$_POST['nim']."', nama='".$_POST['nama']."' where id_alternatif='".$_POST['id']."'";
				mysqli_query($con,$q);
				mysqli_query($con,"delete from klasifikasi where id_alternatif='".$_POST['id']."'");
				for($i=0;$i<count($kriteria);$i++){
					mysqli_query($con,"insert into klasifikasi(id_alternatif, id_himpunan) values('".$_POST['id']."','".$_POST['kriteria_'.$kriteria[$i][0]]."')");
				}
				exit("<script>location.href='?page=nilai';</script>");
			}
		}
		
	}


$action=$_GET['action'];

if($_GET['action']=='edit' and !empty($_GET['id'])){
	$id=$_GET['id'];
	$q=mysqli_query($con,"select * from alternatif where id_alternatif='".$id."'");
	if(mysqli_num_rows($q)>0){
		$h=mysqli_fetch_array($q);
		$nim=$h['nim'];
		$nama=$h['nama'];
		$q=mysqli_query($con,"select * from klasifikasi where id_alternatif='".$id."'");
		while($h=mysqli_fetch_array($q)){
			$himpunan[]=$h['id_himpunan'];
		}
	}
}

$daftar_kriteria='';
for($i=0;$i<count($kriteria);$i++){
	$list_himpunan='<option value=""></option>';
	$qq=mysqli_query($con,"select * from himpunan where id_kriteria='".$kriteria[$i][0]."'");
	while($hh=mysqli_fetch_array($qq)){
		if(in_array($hh['id_himpunan'],$himpunan)){$s='selected';}else{$s='';}
		$list_himpunan.='<option value="'.$hh['id_himpunan'].'" '.$s.'>'.$hh['nama'].'</option>';
	}
	$daftar_kriteria.='
	  <tr>
		<td>'.$kriteria[$i][1].'</td>
		<td><select for="form-field-select-2" class="cs-select cs-skin-elastic"name="kriteria_'.$kriteria[$i][0].'">'.$list_himpunan.'</select> <em>harus diisi</em></td>
	  </tr>
	';
}


?>
  <!-- general form elements disabled -->
             <div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15">Halaman Penilaian Kriteria<span class="text-bold"> Reward Guru</span></h5>
									<p>									</p>
		<form role="form" action="" name="" method="post">
		<div class="form-group">
		<input name="action" type="hidden" value="<?php echo $action;?>">
		<input name="id" type="hidden" value="<?php echo $id;?>">
		<table width="75%" border="0" cellspacing="4" cellpadding="0" class="tabel_reg">
		  <tr>
		  
                      

			<td width="5">NUPTK</td>
			<td width="12"><input name="nim" type="text" size="40" class="form-control" disabled value="<?php echo $nim;?>"> <em><b>harus diisi</b></em></td>
		  </tr>
		  <tr>
			<td>Nama Guru</td>
			<td><input name="nama" type="text" size="40" class="form-control" disabled value="<?php echo $nama;?>"> <em>harus diisi</em></td>
		  </tr>
		 
		  <?php echo $daftar_kriteria;?>
		  <tr>
			<td></td>
			<td><input name="simpan" type="submit" class="btn btn-info" value="Simpan"> <input name="batal" type="button" class="btn btn-default" onClick="location.href='?page=nilai';" value="Batal"></td>
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
