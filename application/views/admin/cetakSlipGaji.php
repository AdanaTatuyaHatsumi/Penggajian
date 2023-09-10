<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title ?></title>
	<style type="text/css">
		body{
			font-family: Arial;
			color: black;
		}
	</style>
</head>
<body>

	<center>
		<h1>PT. INDONESIA MERDEKA</h1>
		<h2>Slip Gaji Pegawai</h2>
		<hr  style="width: 50%; border-width: 5px; color: balck">
	</center>

	<?php 

		if((isset($_POST['bulan']) && $_POST['bulan']!='') && (isset($_POST['tahun']) && $_POST['tahun']!='')){
			$bulan = $_POST['bulan'];
			$tahun = $_POST['tahun'];
			$bulantahun = $bulan.$tahun;
		}else{
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan.$tahun;
		}

	 ?>
	 <?php foreach($potongan as $p) {
	 	$potongan = $p->jml_potongan;
	 }  

	 ?>
	 
	 <?php $no=1; foreach ($print_slip as $ps) : ?>

	 	<?php $potongan_gaji = $ps->alpha * $potongan; ?>
	 <table style="width: 100%">
	 	<tr>
	 		<td style="width: 20%">Nama Pegawai</td>
	 		<td style="width: 2%">:</td>
	 		<td><?php echo $ps->nama_pegawai ?></td>
	 	</tr>
	 	<tr>
	 		<td>Nik</td>
	 		<td>:</td>
	 		<td><?php echo $ps->nik ?></td>
	 	</tr>
	 	<tr>
	 		<td>Jabatan</td>
	 		<td>:</td>
	 		<td><?php echo $ps->nama_jabatan ?></td>
	 	</tr>
	 	<tr>
	 		<td>Bulan</td>
	 		<td>:</td>
	 		<td><?php echo $bulan ?></td>
	 	</tr>
	 	<tr>
	 		<td>Tahun</td>
	 		<td>:</td>
	 		<td><?php echo $tahun ?></td>
	 	</tr>
	 </table>

	 <table class="table table-striped table-bordered mt-3">
	 	<tr>
	 		<th class="text-center" style="width: 5%">No</th>
	 		<th class="text-center">Keterangan</th>
	 		<th class="text-center">Jumlah</th>
	 	</tr>
	 	<tr>
	 		<td><?php echo  $no++ ?></td>
	 		<td>Gaji Pokok</td>
	 		<td>Rp.<?php echo number_format($ps->gaji_pokok,0,',','.') ?></td>
	 	</tr>
	 	<tr>
	 		<td><?php echo  $no++ ?></td>
	 		<td>Tunjangan Transportasi</td>
	 		<td>Rp.<?php echo number_format($ps->tj_transport,0,',','.') ?></td>
	 	</tr>
	 	<tr>
	 		<td><?php echo  $no++ ?></td>
	 		<td>Uang Makan</td>
	 		<td>Rp.<?php echo number_format($ps->uang_makan,0,',','.') ?></td>
	 	</tr>
	 	<tr>
	 		<td><?php echo  $no++ ?></td>
	 		<td>Potongan</td>
	 		<td>Rp.<?php echo number_format($potongan_gaji,0,',','.') ?></td>
	 	</tr>
	 	<tr>
	 		<th colspan="2" style="text-align: right;">Total Gaji</th>
	 		<th>Rp.<?php echo number_format($ps->gaji_pokok+$ps->tj_transport+$ps->uang_makan-$potongan_gaji,0,',','.') ?></th>
	 	</tr>
	 </table>

	 <table style="width: 100%">
	 	<tr>
	 		<td></td>
	 		<td>
	 			<p>Pegawai</p>
	 			<br>
	 			<br>
	 			<p class="font-weight-bold"><?php echo $ps->nama_pegawai ?></p>
	 		</td>
	 		<td style="width: 200px">
	 			<p>Makassar, <?php echo date("d M Y") ?><br>Finance,</p>
	 			<br>
	 			<br>
	 			<p>_________________________</p>
	 		</td>
	 	</tr>
	 </table>

	<?php endforeach; ?>
</body>
</html>
<script type="text/javascript">
	window.print();
</script>