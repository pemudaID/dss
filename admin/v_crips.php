<?php
  
if(!isset($_SESSION['LOGIN_username'])){
	exit("<script>location.href='./';</script>");
}
$id_kriteria='';
if(isset($_POST['kriteria'])){
	$id_kriteria=$_POST['kriteria'];
}elseif(isset($_GET['kriteria'])){
	$id_kriteria=$_GET['kriteria'];
}

$nav_link='page=data_himpunan';
$edit_link='page=update_himpunan';
$no=0;
$daftar='';
$sql=mysqli_query($con,"select * from himpunan where id_kriteria='".$id_kriteria."'");
if(mysqli_num_rows($sql) > 0){
	while($h=mysqli_fetch_array($sql)){
		$no++;
		$daftar.='
		<tbody>
			
		  <tr>
			<td valign="top">'.$no.'</td>
			<td valign="top">'.$h['nama'].'</td>
			<td valign="top" align="center">'.$h['nilai'].'</td>
			<td align="center" valign="top"><div class="btn-group">
										<button type="button" class="btn btn-danger">
											Action
										</button>
										<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li role="presentation" class="dropdown-header">
												Pilih Aksi
											</li>
											<li>
												<a href="#" onclick="DeleteConfirm(\'?'.$edit_link.'&id='.$h['id_himpunan'].'&action=delete\');return(false);">
													Hapus
												</a>
											</li>
											<li>
												<a href="?'.$edit_link.'&amp;id='.$h['id_himpunan'].'&amp;action=edit">
													Edit
												</a>
											</li>
											
										</ul>
									</div></td>
		  </tr></tbody>
		';
	}
}
# menampilkan data kriteria yang bertipe combo
$list_kriteria='<option value="">Pilih Kriteria--</option>';
$q=mysqli_query($con,"select * from kriteria");
if(mysqli_num_rows($q)>0){
	while($h=mysqli_fetch_array($q)){
		if($id_kriteria==$h['id_kriteria']){$s='selected';}else{$s='';}
		$list_kriteria.='<option value="'.$h['id_kriteria'].'" '.$s.'>'.$h['nama'].'</option>';
	}
}


?>
<script language="javascript">
function DeleteConfirm(url){
	if (confirm("Apakah anda yakin ingin menghapus ?")){
		window.location.href=url;
	}
}
</script>
<div class="container-fluid container-fullw bg-white">
        <div class="row">
								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15">Nilai Crips <span class="text-bold">Kriteria</span></h5>
									
		<form action="" method="post">
		<input name="cmd_show" type="hidden" value="true" />
		<table width="50%" border="0" cellspacing="4" cellpadding="0" class="tabel_reg">
		  <tr>
			<td width="120">Nama Kriteria</td>
			<td><select class="form-control" name="kriteria" onchange="submit()"><?php echo $list_kriteria;?></select></td>
		  </tr>
		</table>
		</form>
		<br>
		<div align="right"><?php if($id_kriteria>0){?><a class=" fa fa-plus btn btn-wide btn-primary" href="?page=update_himpunan&amp;action=new&id2=<?php echo $id_kriteria;?>">Tambah Data</a><?php } ?></div><br>
		<div class="table-responsive">
							<table class="table table-hover">
				
		<thead>
		  <tr>
			<td align="center" width="40">NO</td>
			<td align="center" width="140">NAMA</td>
			<td align="center" width="20">NILAI</td>
			<td align="center" width="100">AKSI</td>
		  </tr>
		  </thead>
		  <?php echo $daftar;?>
		</table>


    	</div>
