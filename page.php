<?php
  
$page='';
if(isset($_GET['page'])){
	$page=$_GET['page'];
}
switch($page){
	case 'login':
		$page="include 'includes/p_login.php';";
		break;
	case 'data_guru':
		$page="include 'admin/v_guru.php';";
		break;
	case 'add_guru':
		$page="include 'admin/add_guru.php';";
		break;
	case 'update_guru':
		$page="include 'admin/u_guru.php';";
		break;
	case 'data_kriteria':
		$page="include 'admin/v_kriteria.php';";
		break;
	case 'ubah_kriteria':
		$page="include 'admin/u_kriteria.php';";
		break;
	case 'add_kriteria':
		$page="include 'admin/add_kriteria.php';";
		break;
	case 'data_himpunan':
		$page="include 'admin/v_crips.php';";
		break;
	case 'update_himpunan':
		$page="include 'admin/add_crips.php';";
		break;
	case 'data_klasifikasi':
		$page="include 'admin/p_klasifikasi.php';";
		break;
	case 'hasil':
		$page="include 'admin/p_hasil.php';";
		break;
	case 'analisa':
		$page="include 'admin/p_analisa.php';";
		break;
	case 'nilai':
		$page="include 'admin/v_nilai.php';";
		break;
	case 'update_nilai':
		$page="include 'admin/u_nilai.php';";
		break;
	case 'keluar':
		$page="include 'logout.php';";
		break;
	default:
		$page="include 'includes/front.php';";
		break;
}
$CONTENT_["main"]=$page;
?>