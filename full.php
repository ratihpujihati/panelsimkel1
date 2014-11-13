<?php include "koneksi.php" ?>
<?php include "selisih.php" ?>
 <?php date_default_timezone_set('Asia/Jakarta'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700' rel='stylesheet' type='text/css'>
    <link href="../assets/css/bootstrapTheme.css" rel="stylesheet">
    <link href="../assets/css/custom.css" rel="stylesheet">	
	

    <!-- Owl Carousel Assets -->
    <link href="../owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="../owl-carousel/owl.theme.css" rel="stylesheet">

    <link href="../assets/js/google-code-prettify/prettify.css" rel="stylesheet">

	
    <!-- Le fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
	  <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
					
<style>
			.biru {				
				background: #3498db !important;
			
				color: #424251;
			}
			
			.kuning {				
				background: #FF9326 !important;
			
				color: #424251;
			}
			
			.hijau {				
				background: #3fbf79 !important;
			
				color: #424251;
				
			}
			
			.lama {
				font-size: 15px;
			}
			
			
</style>   

  </head>
  <body>    
   

      <div id="demo">

        <div id="owl-demo" class="owl-carousel owl-theme">
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------andonikah
			$handonnikah = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_andonnikah an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($handonnikah)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h3>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h3>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h3>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h3>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">						
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h3>". $row['waktu_selesai']."</h3>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>
				<p><h2><?php echo $row['nama']?></h2></p>
				<p><h3>Andon Nikah</h3></p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>		
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai andonnikah
		?>	  


		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------belum menikah
			$belummenikah = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_belummenikah an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)  				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($belummenikah)) {
			   if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Keterangan Belum Menikah</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai belummenikah
		?>	
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------bd
			$bd = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
								from data_penduduk dp, permintaan_bd an,pengguna p, data_pegawai di
								where an.nik=dp.nik 
										and p.id_data_pegawai = di.id_data_pegawai
								and (an.antrian_oleh = p.id_pengguna
									or an.proses_oleh = p.id_pengguna)	 				
									order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($bd)) {
			   if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Keterangan Bersih Diri</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>		
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai bd
		?>	
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------bpr
			$bpr = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
									from data_penduduk dp, permintaan_bpr an,pengguna p, data_pegawai di
									where an.nik=dp.nik 
											and p.id_data_pegawai = di.id_data_pegawai
									and (an.antrian_oleh = p.id_pengguna
										or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   			
										order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($bpr)) {
			    if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Keterangan Belum Punya Rumah</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai bpr
		?>	
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------domisili_parpol
			$domisili_parpol = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_domisili_parpol an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($domisili_parpol)) {
			   if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>
				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Keterangan Domisili Parpol</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>		
				<p><?php echo $lama ;echo $row['waktu_antrian']	?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai domisili_parpol
		?>	
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------domisili_perusahaan
			$domisili_perusahaan = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_domisili_perusahaan an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($domisili_perusahaan)) {
			 if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Keterangan Domisili Perusahaan</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai domisili_perusahaan
		?>	
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------domisili_yayasan
			$domisili_yayasan = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_domisili_yayasan an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($domisili_yayasan)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Keterangan Domisili Yayasan</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai domisili_yayasan
		?>	
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------ibadahhaji
			$ibadahhaji = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_ibadahhaji an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna) and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   					
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($ibadahhaji)) {
			   if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Domisili Khusus Haji</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai ibadahhaji
		?>	
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------ik
			$ik = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_ik an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($ik)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Keterangan Ijin Keramaian</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai ik
		?>	
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------janda / Duda
			$janda = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_janda an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna 
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($janda)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Keterangan Janda / Duda</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai janda / Duda
		?>	
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------keterangan_tempat_usaha
			$keterangan_tempat_usaha = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_keterangan_tempat_usaha an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW()) 				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($keterangan_tempat_usaha)) {
			   if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Keterangan Usaha</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai keterangan_tempat_usaha
		?>	
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------lahir
			$lahir = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_lahir an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)		and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW()) 			
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($lahir)) {
			   if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Keterangan Kelahiran</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai lahir
		?>   
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------mati
			$mati = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_mati an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($mati)) {
			   if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Keterangan Kematian</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai mati
		?>	  
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------ps
			$ps = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_ps an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($ps)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>SKCK</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>		
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai ps
		?> 
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------rumahsakit
			$rumahsakit = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_rumahsakit an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($rumahsakit)) {
			 if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>SKTM Rumah Sakit</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai rumahsakit
		?> 
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------sekolah
			$sekolah = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_sekolah an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($sekolah)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>SKTM Pendidikan</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai sekolah
		?> 
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------serbaguna
			$serbaguna = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_serbaguna an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($serbaguna)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Lain - Lain</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai serbaguna
		?>
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------NA
			$na = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_na an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($na)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Nikah (NA)</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai NA
		?>  
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------Adm. Cerai
			$adm_cerai = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_adm_cerai an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($adm_cerai)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Adm. Cerai</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai adm_cerai
		?>
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------Kartu Identitas Kerja
			$kartuidentitaskerja = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_kartuidentitaskerja an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($kartuidentitaskerja)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Kartu Identitas Kerja</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai kartu identitas kerja
		?>     
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------Domisili Panitia Pembangunan
			$domisili_panitia_pembangunan = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_domisili_panitia_pembangunan an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($domisili_panitia_pembangunan)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Domisili Panitia Pembangunan</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai Domisili Panitia Pembangunan
		?>  
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------imb
			$imb = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_imb an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($imb)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Ijin Mendirikan Bangunan</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------imb
		?>  
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------kk
			$kk = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_kk an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($kk)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Kartu Keluarga (KK)</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------kk
		?>     
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------ktp
			$ktp = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_ktp an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($ktp)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Kartu Tanda Penduduk (KTP)</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------ktp
		?>    

		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------kipem
			$kipem = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_kipem an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($kipem)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>KIPEM</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------kipem
		?>   
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------orang yang sama
			$orang_yang_sama = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_orang_yang_sama an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($orang_yang_sama)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Keterangan Orang yang Sama</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------orang yang sama
		?>  
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------ahli waris
			$waris = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_waris an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($waris)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Keterangan Ahli Waris</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------ahli waris
		?> 
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------Domisili Penduduk
			$domisili_penduduk = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_domisili_penduduk an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($domisili_penduduk)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Keterangan Domisili Penduduk</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------Domisili Penduduk
		?>  
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------ajb
			$ajb = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_ajb an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($ajb)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Ket. Tanah & Bangunan (AJB)</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------ajb
		?>     
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------sertifikat
			$sertifikat = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_sertifikat an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($sertifikat)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Ket. Tanah & Bangunan (Sertifikat)</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------sertifikat
		?>  
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------surat kuasa
			$suratkuasa = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_suratkuasa an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($suratkuasa)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Surat Kuasa</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------surat kuasa
		?>     
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------mutasi
			$mutasi = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_pbb_mutasi an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($mutasi)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Mutasi Balik Nama PBB</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------mutasi
		?>    
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------penerbitan
			$penerbitan = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_pbb_penerbitan an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($penerbitan)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Penerbitan SPPT PBB</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------penerbitan
		?>   
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------split
			$split = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_pbb_split an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($split)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Split PBB Pemecahan</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------split
		?>  
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------mati baru
			$mati_baru = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_mati_baru an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($mati_baru)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Keterangan Kematian</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------mati baru
		?>     
		
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------lahir baru
			$lahir_baru = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
											from data_penduduk dp, permintaan_lahir_baru an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
											and (an.antrian_oleh = p.id_pengguna
												or an.proses_oleh = p.id_pengguna)	and DATE_FORMAT(an.tanggal_surat,'%d') = DAY(NOW())   				
												order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
			while ($row = mysql_fetch_array($lahir_baru)) {
			  if($row['status']=='1'){ 
				$row['status']='Masuk Antrian';
				$waktu ="Waktu Antri: ". $row['waktu_antrian'];
				$oleh ="Petugas : ". $row['nama_pegawai'];
				$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				?>  				
				<div class="biru">			
			<?php }else if($row['status']=='2'){ ?>			
				<div class="kuning">
				<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = "Sudah menunggu: <br /><h4>" .selisih($row['waktu_antrian'],$waktu_sekarang)."</h4>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">
					<?php		$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: <br /><h4>". $row['waktu_selesai']."</h4>";	
								$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>				
				<p><h3><?php echo $row['nama']?></h3></p>
				<p>Keterangan Kelahiran</p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>	
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------lahir baru
		?>     

        </div>

    </div>  

    <script src="../assets/js/jquery-1.9.1.min.js"></script> 
    <script src="../owl-carousel/owl.carousel.js"></script>

    <!-- Demo -->

    <style>
	#demo{
		margin-top:2%;
	}
	#biru {
		width: 30px;
		height: 20px;
		background: #3498db;
	}
	
	#kuning {
		width: 30px;
		height: 20px;
		background: #D2FF4C;
	}
	
	#hijau {
		width: 30px;
		height: 20px;
		background: #3fbf79;
	}
    #owl-demo .biru{
        background: #3498db;
        padding: 25px 0px;
        margin: 5px;
        color: #FFF;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        text-align: center;
		-moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		-webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    }
	
	#owl-demo .kuning{
        background: #FF9326;
        padding: 25px 0px;
        margin: 5px;
        color: #FFF;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        text-align: center;
		-moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		-webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    }
	#owl-demo .hijau{
        background: #3fbf79;
        padding: 25px 0px;
        margin: 5px;
        color: #FFF;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        text-align: center;
		-moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		-webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    }
	 {
	background: #3fbf79;
	}
    </style>

    <script>
    $(document).ready(function() {
      $("#owl-demo").owlCarousel({
		items : 5,
		autoPlay: true
      });
    });

    </script>
	<script type="text/javascript"> 
      // $(document).ready( function() {
        // $('.hijau').delay(10000).fadeOut();
      // });
	  
	$('html').addClass('js');

	$(function() {

		  var timer = setInterval( showDiv, 20000); //2o detik

		 jam = document.getElementByClass('hijau');

		  function showDiv() {   

			 $('.hijau').fadeOut();

		  }

	});
    </script>
    

    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>

    <script src="../assets/js/google-code-prettify/prettify.js"></script>
	  <script src="../assets/js/application.js"></script>
	  
	  
	
  </body>
</html>
