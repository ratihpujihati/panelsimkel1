<?php include "koneksi.php";
	include "selisih.php" ;
?>
 <?php date_default_timezone_set('Asia/Jakarta'); ?>
 <head>
   
    <link href="../css/table.css" rel="stylesheet">	

  </head>
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
			
			
</style>   

<?php
			//andonikah
			
			$handonnikah = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
				from data_penduduk dp, permintaan_andonnikah an,pengguna p, data_pegawai di
				where an.nik=dp.nik 
                        and p.id_data_pegawai = di.id_data_pegawai
				and (an.antrian_oleh = p.id_pengguna
					or an.proses_oleh = p.id_pengguna)
					
					order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
				
			
			?> 
			
	<h2 class="judul">Surat Permintaan Andon Nikah</h2>
	<table>
	<thead>
		<th>No</th>
		<th>No Registrasi</th>
		<th>Nik</th>
		<th>Nama</th>	
		<th>Petugas</th>
		<th>Status</th>
		<th>Lama Menunggu</th>
	</thead>
	<?php while ($row = mysql_fetch_array($handonnikah) or die (mysql_error())) {?>
			
			<?php 
			$waktu_sekarang = date("H:i:s");
			
			
			if($row['status']=='1'){ ?>
					
					<?php
						$kelas='biru';
						$row['status']='Masuk Antrian';
						$waktu ="Waktu Antri: ". $row['waktu_antrian'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = selisih($row['waktu_antrian'],$waktu_sekarang);	
					?>  
					<?php }else if($row['status']=='2'){
						$kelas='kuning';
						$row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = selisih($row['waktu_antrian'],$waktu_sekarang);	
					
					?>
						
				<?php }else if($row['status']=='3'){ 
							$kelas='hijau';
							$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: ". $row['waktu_selesai'];	
								$lama = $waktu;	
					 }?>
	<tbody>
	<tr class="<?php echo $kelas;?>">
		<td><?php echo $no?></td>
		<td><?php echo $row['no_registrasi']?></td>
		<td><?php echo $row['nik']?></td>
		<td><?php echo $row['nama']?></td>		
		<td><?php echo $row['nama_pegawai']?></td>
		<td><?php echo $row['status']?></td>
		<td><?php echo $lama ?></td>
	</tr>
	</tbody>
	
	<?php
			$no++;
		}
		?>	

</table>	

 <?php
			//andonikah
			
			$handonnikah = mysql_query("select an.waktu_antrian,dp.nik,dp.nama,dp.alamat,an.no_registrasi, an.status, an.waktu_antrian, an.antrian_oleh,an.proses_oleh, di.nama_pengguna as nama_pegawai, an.waktu_proses,an.waktu_selesai, DATE_FORMAT(an.tanggal_surat,'%d') as tanggal_surat 
				from data_penduduk dp, permintaan_andonnikah an,pengguna p, data_pegawai di
				where an.nik=dp.nik 
                        and p.id_data_pegawai = di.id_data_pegawai
				and (an.antrian_oleh = p.id_pengguna
					or an.proses_oleh = p.id_pengguna)
					
					order by an.no_registrasi desc") or die (mysql_error());
			$no = 1;
				
			
			?> 
			
	<h2 class="judul">Surat Permintaan Andon Nikah</h2>
	<table>
	<thead>
		<th>No</th>
		<th>No Registrasi</th>
		<th>Nik</th>
		<th>Nama</th>	
		<th>Petugas</th>
		<th>Status</th>
		<th>Lama Menunggu</th>
	</thead>
	<?php while ($row = mysql_fetch_array($handonnikah) or die (mysql_error())) {?>
			
			<?php 
			$waktu_sekarang = date("H:i:s");
			
			
			if($row['status']=='1'){ ?>
					
					<?php
						$kelas='biru';
						$row['status']='Masuk Antrian';
						$waktu ="Waktu Antri: ". $row['waktu_antrian'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = selisih($row['waktu_antrian'],$waktu_sekarang);	
					?>  
					<?php }else if($row['status']=='2'){
						$kelas='kuning';
						$row['status']='Masih dalam proses';
						$waktu = "Waktu Proses: ". $row['waktu_proses'];
						$oleh ="Petugas : ". $row['nama_pegawai'];
						$lama = selisih($row['waktu_antrian'],$waktu_sekarang);	
					
					?>
						
				<?php }else if($row['status']=='3'){ 
							$kelas='hijau';
							$row['status']='Surat telah selesai';	
								$waktu = "Waktu  selesai: ". $row['waktu_selesai'];	
								$lama = $waktu;	
					 }?>
	<tbody>
	<tr class="<?php echo $kelas;?>">
		<td><?php echo $no?></td>
		<td><?php echo $row['no_registrasi']?></td>
		<td><?php echo $row['nik']?></td>
		<td><?php echo $row['nama']?></td>		
		<td><?php echo $row['nama_pegawai']?></td>
		<td><?php echo $row['status']?></td>
		<td><?php echo $lama ?></td>
	</tr>
	</tbody>
	
	<?php
			$no++;
		}
		?>	

</table>			
					
					
					