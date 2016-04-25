
		<?php if(!empty($_SESSION['LOGIN_username'])){?>
		
		<div id="slider_menu"><h2 class="title" id="menu_utama"> Menu Admin </h2>
		<ul id="menu_utama_ul">
		<li><a href="./">Halaman Depan</a></li>
		<li><a href="?page=data_kriteria">Master Data Kriteria</a></li>
		<li><a href="?page=data_himpunan">Master Data Himpunan Kriteria</a></li>
		<li><a href="?page=data_alternatif">Master Data Guru</a></li>
		<li><a href="logout.php">Keluar</a></li>
		</ul>
        </div>
		<div id="slider_menu">
		<ul id="menu_pencarian_ul">
		<li><a href="?hal=hasil"><strong>Hasil Analisa</strong></a></li>
		</ul>
        </div>
		<?php }else{?>
		<div id="slider_menu"><h2 class="title" id="menu_utama"> Menu Utama </h2>
		<ul id="menu_utama_ul">
		<li><a href="./">Halaman Depan</a></li>
		<li><a href="?page=login">Login Admin</a></li>
		</ul>
        </div>
		<?php }?>
		
        <div class="spacer_float"></div>
