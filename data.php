<?php include "koneksi.php" ?>

<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Sistem Informasi Manajemen Kelurahan Leuwigajah</title>
		<meta name="description" content="Sistem Informasi Manajemen Kelurahan Leuwigajah" />
		<meta name="keywords" content="Sistem Informasi Manajemen Kelurahan Leuwigajah" />
		<meta name="author" content="riza dan ratih" />
		<link rel="shortcut icon" href="images/cimahi.png"> 
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/easySlider1.7.js"></script>
		<script src="js/modernizr.custom.js"></script>
		<style>
			.biru {				
				background: #3498db;
				border: 3px solid #0086B3;
				
			}
			
			.kuning {				
				background: #FF9326;
				border: 3px solid #FF8000;
				
			}
			
			.hijau {				
				background: #3fbf79;
				border: 3px solid #00B32D;
				
			}
		</style>
		
		
   
	</head>
	<body>
		
			<ul class="grid effect-8" id="grid">
			<div id="owl-demo" class="owl-carousel">
			<?php
			//andonikah
			
			$handonnikah = mysql_query("select dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
										from data_penduduk dp, permintaan_andonnikah an
										where an.nik=dp.nik 
										order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
				while ($row = mysql_fetch_array($handonnikah) or die (mysql_error())) {
			
			?> 
			
			<li class="animate">
			<?php if($row['status']=='1'){ ?>
					<div class="card biru">	
				<?php $row['status']='Masuk Antrian';
						$waktu ="Waktu Antri: ". $row['waktu_antrian'];
						$oleh ="Petugas : ". $row['antrian_oleh'];
				?>  
					

			<?php }else if($row['status']=='2'){ ?>	
					<div class="card kuning">
					<?php $row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['proses_oleh'];
					
					?>
						
			<?php }else if($row['status']=='3'){ ?>	
					<div class="card hijau">
					<?php $row['status']='Surat telah selesai';	
							$waktu = "Waktu  selesai: ". $row['waktu_selesai'];					
				 }?>				
					<div class="isi ">
						Nomor Registrasi : <b><?php echo $row['no_registrasi']?></b>
						<br /><font size="6px"><b><?php echo $row['nama']?></b></font>
						<br /><?php echo $row['alamat']?>
						<br />Surat Permintaan Andon Nikah
						<br /> <?php echo $waktu?>
						<br /> <?php echo $oleh?>
						</div>
						<div class="status clearfix">
							<?php echo $row['status']?><br />							
						</div>
					</div>
			</li>	
				
			<?php
			$no++;
		}
		?>	</div>
			</ul>
		
		  <script src="../assets/js/jquery-1.9.1.min.js"></script> 
			<script src="../owl-carousel/owl.carousel.js"></script>
			
			
		<script src="js/masonry.pkgd.min.js"></script>
		<script src="js/imagesloaded.js"></script>
		<script src="js/classie.js"></script>
		<script src="js/AnimOnScroll.js"></script>
		<script>
			new AnimOnScroll( document.getElementById( 'grid' ), {
				minDuration : 0.4,
				maxDuration : 0.7,
				viewportFactor : 0.2
			} );
		</script>
		 <script>
			$(document).ready(function() {
			  $("#owl-demo").owlCarousel({
				navigation : true,
				autoPlay: true
			  });
			});

    </script>
	 <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>

    <script src="../assets/js/google-code-prettify/prettify.js"></script>
	  <script src="../assets/js/application.js"></script>
	</body>
</html>