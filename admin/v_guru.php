<?php
  
if(!isset($_SESSION['LOGIN_username'])){
	exit("<script>location.href='./';</script>");
}

$nav_link='page=data_guru';
$edit_link='page=update_guru';
$no=0;
$daftar='';
$q="select * from alternatif order by nama";
$q=mysqli_query($con,$q);
if(mysqli_num_rows($q) > 0){
	while($h=mysqli_fetch_array($q)){
		$no++;
		$daftar.='
		  <tr>
			<td valign="top">'.$no.'</td>
			<td valign="top">'.$h['nim'].'</td>
			<td valign="top">'.$h['nama'].'</td>
			<td valign="top">'.$h['mapel'].'</td>
			<td valign="top">'.$h['Alamat'].'</td>
			<td align="center" valign="top">
<div class="btn-group">
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
												<a href="#" onclick="DeleteConfirm(\'?'.$edit_link.'&id='.$h['id_alternatif'].'&action=delete\');return(false);">
													Hapus
												</a>
											</li>
											<li>
												<a href="?'.$edit_link.'&amp;id='.$h['id_alternatif'].'&amp;action=edit">
													Edit
												</a>
											</li>
											
										</ul>
									</div></td>
		  </tr>
		';
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
									<h5 class="over-title margin-bottom-15">Data <span class="text-bold">Master Guru</span></h5>
									<p>
									Berikut ini Master Data Guru : 
									</p>
        
		<div align="right"><a href="?page=add_guru&amp;action=tambah" class=" fa fa-plus btn btn-wide btn-primary">Tambah Data Guru</a></div><br>
		<div class="table-responsive">
							<table class="table table-hover">
				
		<thead>
		<tr>
			<td align="center" width="40">NO</td>
			<td align="center" width="140">NUPTK</td>
			<td align="center" width="140">NAMA GURU</td>
			<td align="center" width="200">MATA PELAJARAN</td>
			<td align="center" width="200">ALAMAT</td>
			<td align="center" width="40">AKSI</td>
		  </tr>
		  </thead>
		  <?php echo $daftar;?>
		</table>

		

    	</div>
