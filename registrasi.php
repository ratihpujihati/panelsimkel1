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
			h3{
				font-size: 16px;
				font-weight: bold;
			}
			
			
</style>   

  </head>
  <body>    
   

      <div id="demo">

        <div id="owl-demo" class="owl-carousel owl-theme">
		<?php
			$waktu_sekarang = date("H:i:s");
			//-----------------------------------------------andonikah
			$handonnikah = mysql_query("select an.id_surat, an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tgl_dibuat,'%d') as tanggal_surat 
											from data_penduduk dp, no_registrasi an,pengguna p, data_pegawai di
											where an.nik=dp.nik 
													and p.id_data_pegawai = di.id_data_pegawai
													and DATE_FORMAT(an.tgl_dibuat,'%d') = DAY(NOW())
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
						$lama = "Sudah menunggu: <br /><h3>" . selisih($row['waktu_antrian'],$waktu_sekarang)."</h3>";	
				
			?>
			<?php }else if($row['status']=='3'){ ?>	
					<div class="hijau">						
					<?php		$row['status']='Surat telah selesai';	
								//$lama = "Waktu  selesai: <br /><h3>". selisih($row['waktu_selesai'],$row['waktu_antrian'])."</h3>";	
								$lama = "Waktu  selesai: <br /><h3>".selisih($row['waktu_antrian'],$row['waktu_selesai'])."</h3>";	
								//$lama = $waktu;	
					 }?>
					 
				<?php echo $lama;?>	
				<p>No Registrasi: <?php echo $row['no_registrasi']?></p>
				<p><h2><?php echo $row['nama']?></h2></p>
				<p><h3><? echo $row['id_surat'] ?></h3></p>	
				<p>Petugas : <?php echo $row['nama_pegawai']?></p>		
			</div>
		<?php
			
			$no++;
			}
			//-----------------------------------------------selesai andonnikah
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
      // // $(document).ready( function() {
        // // $('.hijau').delay(10000).fadeOut();
      // // });
	  
	// $('html').addClass('js');

	// $(function() {

		  // var timer = setInterval( showDiv, 20000); //2o detik

		 // jam = document.getElementByClass('hijau');

		  // function showDiv() {   

			 // $('.hijau').fadeOut();

		  // }

	// });
    </script>
    

    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>

    <script src="../assets/js/google-code-prettify/prettify.js"></script>
	  <script src="../assets/js/application.js"></script>
	  
	  
	
  </body>
</html>
