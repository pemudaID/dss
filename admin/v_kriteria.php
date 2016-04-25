<?php
  
if(!isset($_SESSION['LOGIN_username'])){
	exit("<script>location.href='./';</script>");
}
$nav_link='page=data_kriteria';
$edit_link='page=ubah_kriteria';

$no=0;
$daftar='';
$bobot=array(0=>'',1=>'Sangat Rendah',2=>'Rendah',3=>'Cukup',4=>'Tinggi',5=>'Sangat Tinggi');
$q=mysqli_query($con,"select * from kriteria");
if(mysqli_num_rows($q) > 0){
	while($h=mysqli_fetch_array($q)){
		$no++;
		$daftar.='
		  <tbody>
			<tr>
			<td valign="top" >'.$no.'</td>
			<td valign="top">'.$h['inisial'].'</td>
			<td valign="top">'.$h['nama'].'</td>
			<td valign="top">'.$h['atribut'].'</td>
			<td valign="top">'.$bobot[$h['bobot']].'</td>
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
												<a href="#" onclick="DeleteConfirm(\'?'.$edit_link.'&id='.$h['id_kriteria'].'&action=delete\');return(false);">
													Hapus
												</a>
											</li>
											<li>
												<a href="?'.$edit_link.'&amp;id='.$h['id_kriteria'].'&amp;action=edit">
													Edit
												</a>
											</li>
											
										</ul>
									</div></td>
		  </tr>
		  
		  </tbody>
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
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/core.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/components.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<!-- /theme JS files -->

<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15">Data <span class="text-bold">Kriteria & Bobot</span></h5>
									<p>
									Berikut ini adalah Data Kriteria Penilaian Reward : 
									</p>
			
		<div align="right"><a href="?page=add_kriteria&amp;action=new" class=" fa fa-plus btn btn-wide btn-primary"> Tambah Data</a></div><br>
		<div class="table-responsive">
							<table class="table table-hover">
				
		<thead>
		  <tr>
			<th align="center" width="40">NO</th>
			<th align="center" width="40">INISIAL</th>
			<th align="center" width="30">KRITERIA PENILAIAN REWARD</th>
			<th align="center" width="40">ATRIBUT</th>
			<th align="center" width="40">BOBOT</th>
			<th align="center" width="40">AKSI</th>
		  </tr>
		  </thead>
		  <?php echo $daftar;?>
		</table>
		</div>

<script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>