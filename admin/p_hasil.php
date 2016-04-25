<?php
  

if(!isset($_SESSION['LOGIN_username'])){
	exit("<script>location.href='./';</script>");
}

if(isset($_POST['new'])){
	session_unregister('ANALISA_KRITERIA');
	exit("<script>location.href='?page=analisa';</script>");
}

# baca jumlah kriteria
$jumlah_kriteria=mysqli_num_rows(mysqli_query($con,"select * from kriteria"));
# baca jumlah alternatif
$jumlah_alternatif=mysqli_num_rows(mysqli_query($con,"select * from alternatif"));

# baca data alternatif
$alternatif=array();
$title='';
$q=mysqli_query($con,"select * from alternatif order by nama");
while($h=mysqli_fetch_array($q)){
	$alternatif[]=array($h['id_alternatif'],$h['nim'],$h['nama']);
	$title.='<td align="center" width="240">'.strtoupper($h['nama']).'</td>';
}

# baca data kriteria dan nilai bobot dari form input analisa
$kriteria=array();
$q=mysqli_query($con,"select * from kriteria");
while($h=mysqli_fetch_array($q)){
	$kriteria[]=array($h['id_kriteria'],$h['inisial'],$h['atribut'],$h['bobot']);
}

$no=0;
$daftar='<td width="40">NO</td><td width="100">NIM</td><td width="150">NAMA</td>';
for($i=0;$i<count($kriteria);$i++){
	$daftar.='<td>'.$kriteria[$i][1].'</td>';
}
$daftar='<tr>'.$daftar.'</tr>';
for($i=0;$i<count($alternatif);$i++){
	$no++;
	$daftar.='<tr><td>'.$no.'</td><td>'.$alternatif[$i][1].'</td><td>'.$alternatif[$i][2].'</td>';
	for($ii=0;$ii<count($kriteria);$ii++){
		$q=mysqli_query($con,"select himpunan.nama from klasifikasi inner join himpunan on klasifikasi.id_himpunan=himpunan.id_himpunan where klasifikasi.id_alternatif='".$alternatif[$i][0]."' and himpunan.id_kriteria='".$kriteria[$ii][0]."'");
		$h=mysqli_fetch_array($q);
		$himpunan=$h['nama'];
		$daftar.='<td>'.$himpunan.'</td>';
	}
	$daftar.='</tr>';
}

$no=0;
$daftar_1='<td width="40">NO</td><td width="100">NIM</td><td width="150">NAMA</td>';
for($i=0;$i<count($kriteria);$i++){
	$daftar_1.='<td>'.$kriteria[$i][1].'</td>';
}
$daftar_1='<tr>'.$daftar_1.'</tr>';
for($i=0;$i<count($alternatif);$i++){
	$no++;
	$daftar_1.='<tr><td>'.$no.'</td><td>'.$alternatif[$i][1].'</td><td>'.$alternatif[$i][2].'</td>';
	for($ii=0;$ii<count($kriteria);$ii++){
		$q=mysqli_query($con,"select himpunan.nilai from klasifikasi inner join himpunan on klasifikasi.id_himpunan=himpunan.id_himpunan where klasifikasi.id_alternatif='".$alternatif[$i][0]."' and himpunan.id_kriteria='".$kriteria[$ii][0]."'");
		$h=mysqli_fetch_array($q);
		$nilai=$h['nilai'];
		# catat nilai himpunan ke dalam matriks
		$matriks_x[$i+1][$ii+1]=$nilai;
		$daftar_1.='<td>'.$nilai.'</td>';
	}
	$daftar_1.='</tr>';
}

# NORMALISASI 1
$no=0;
$daftar_2='<td width="40">NO</td><td width="100">NIM</td><td width="150">NAMA</td>';
for($i=0;$i<count($kriteria);$i++){
	$daftar_2.='<td>'.$kriteria[$i][1].'</td>';
}
$daftar_2='<tr>'.$daftar_2.'</tr>';
for($i=0;$i<count($alternatif);$i++){
	$no++;
	$daftar_2.='<tr><td>'.$no.'</td><td>'.$alternatif[$i][1].'</td><td>'.$alternatif[$i][2].'</td>';
	for($ii=0;$ii<count($kriteria);$ii++){
		$arr='';
		for($j=0;$j<count($alternatif);$j++){ # alternatif
			$arr[]=$matriks_x[$j+1][$ii+1];
		}
		if($kriteria[$ii][2]=='benefit'){
			if($matriks_x[$i+1][$ii+1]>0){$jml=$matriks_x[$i+1][$ii+1]/max($arr);}else{$jml=0;}
		}else{
			if(min($arr)>0){$jml=min($arr)/$matriks_x[$i+1][$ii+1];}else{$jml=0;}
		}
		$matriks_1[$i+1][$ii+1]=round($jml,3);
		$daftar_2.='<td>'.round($jml,3).'</td>';
	}
	$daftar_2.='</tr>';
}

// NORMALISASI 2
for($i=0;$i<count($alternatif);$i++){
	$jml=0;
	for($ii=0;$ii<count($kriteria);$ii++){
		$jml=$jml + ($kriteria[$ii][3]*$matriks_1[$i+1][$ii+1]);
	}
	$hasil[]=array(round($jml,3),$alternatif[$i][0]);
}
sort($hasil);
for($i=count($hasil)-1;$i>=0;$i--){
	$rank=count($hasil)-$i;
	$hasil_akhir[$hasil[$i][1]]=array($hasil[$i][0],$rank);
}

$no=0;
$daftar_3='<td width="40">NO</td><td width="100">NIM</td><td>NAMA</td><td width="100">NILAI</td><td width="100">RANK</td>';
$daftar_3='<tr>'.$daftar_3.'</tr>';
for($i=0;$i<count($alternatif);$i++){
	$no++;
	$daftar_3.='<tr><td>'.$no.'</td><td>'.$alternatif[$i][1].'</td><td>'.$alternatif[$i][2].'</td><td>'.$hasil_akhir[$alternatif[$i][0]][0].'</td><td>'.$hasil_akhir[$alternatif[$i][0]][1].'</td></tr>';
}


?>
<textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
//<![CDATA[
function printDiv(elementId) {
    var a = document.getElementById('printing-css').value;
    var b = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
//]]>
</script>

       <div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15">Hasil  <span class="text-bold">Analisa </span></h5>
									<p>
									Berikut ini Hasil Analisa Nilai Kriteria Guru Penerima Reward : 
									</p>
		<div style="overflow-x:scroll;width:100%">
		<table width="<?php echo (340+($jumlah_kriteria*180));?>" border="0" cellspacing="4" cellpadding="0" class="table table-bordered table-striped">
		  <?php echo $daftar;?>
		</table>
		</div>
		<br /><br />
		<div style="overflow-x:scroll;width:100%">
		<table width="<?php echo (340+($jumlah_kriteria*60));?>" border="0" cellspacing="4" cellpadding="0" class="table table-bordered table-striped">
		  <?php echo $daftar_1;?>
		</table>
		</div>
		<br /><br />NORMALISASI<br /><br />
		<div style="overflow-x:scroll;width:100%">
		<table width="<?php echo (340+($jumlah_kriteria*60));?>" border="0" cellspacing="4" cellpadding="0" class="table table-bordered table-striped">
		  <?php echo $daftar_2;?>
		</table>
		</div>
		<br /><br />
		
		<div id="hasil" style="overflow-x:scroll;width:100%">
		<br /><br />Laporan Hasil Analisa Perhitungan Guru Penerima Reward<br /><br />
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
		  <?php echo $daftar_3;?>
		</table>
		</div>
		<a class="no-print btn btn-info" href="javascript:printDiv('hasil');">Cetak Laporan</a>

		<!--</div>-->

    	</div>

