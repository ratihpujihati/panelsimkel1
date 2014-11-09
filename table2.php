<?php include "koneksi.php";
	include "selisih.php" ;
?>
 <?php date_default_timezone_set('Asia/Jakarta'); ?>


<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript">
	$.fn.infiniteScrollUp=function(){
		var self=this,kids=self.children()
		kids.slice(20).hide()
		setInterval(function(){
			kids.filter(':hidden').eq(0).slideDown()
			kids.eq(0).slideUp(function(){
				$(this).appendTo(self)
				kids=self.children()
			})
		},5000)
		return this
	}
	function cvt(s){
		return function(){
			return $(s).html( $(this).html())
		}
	}
	$(function(){
		$('tbody').replaceWith(cvt('<section/>'))
		$('tr').replaceWith(cvt('<div/>'))
		$('td').replaceWith(cvt('<span/>'))
		$('th').replaceWith(cvt('<b/>'))
		$('section').infiniteScrollUp()
	})
	</script>
	<title>infiniteScrollUp2</title>
	<style type="text/css">
	span,b
	{
		width: 12.05em;
		display: inline-block;
		background-color: #ccc;
		text-align: center;
		
	}
	b{text-align:center}
</style>

</head>
<body>

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


<table border="0" width="100%">
<colgroup><col /><col /><col /><col /><col /><col /></colgroup>
<thead>
<tr><th>a</th><th>b</th><th>c</th><th>d</th><th>e</th><th>f</th></tr>
</thead>
<tbody>
<?php while ($row = mysql_fetch_array($handonnikah) or die (mysql_error())) {?>
<tr><td><?php echo $no?></td><td><?php echo $row['no_registrasi']?></td><td><?php echo $row['nik']?></td><td><?php echo $row['nama']?></td><td><?php echo $row['nama_pegawai']?></td><td><?php echo $row['status']?></td></tr>
<?php
			$no++;
		}
		?>	
<tr><td>1b</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1c</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1d</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1e</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1f</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1g</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1h</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1i</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1j</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1k</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1l</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1m</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1n</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1o</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1p</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1q</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1r</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1s</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1t</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1u</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1v</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1v</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1v</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1v</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1v</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1v</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1v</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1v</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1v</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1v</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1v</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1v</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1v</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1v</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1w</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1x</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1y</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1z</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1z</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1z</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1z</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1z</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1z</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1z</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1z</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1z</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1z</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1z</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1z</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1z</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1z</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1z</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1z</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
<tr><td>1z</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>
</tbody>
</table>
</body>
</html>
