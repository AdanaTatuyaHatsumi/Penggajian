<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title ?></title>
	<style type="text/css">
		body{
			font-family: Arial;
			color : black;
		}
	</style>
</head>
<body>
	<center>
		<h1>PT. INDONESIA MERDEKA</h1>
		<h2>Laporan Kehadiran</h2>
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

	<table>
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
	<table class="table table-bordered table-striped">
		
		<tr>
			<th>NO</th>
			<th>Nama Pegawai</th>
			<th>NIK</th>
			<th>Jabatan</th>
			<th>Hadir</th>
			<th>Sakit</th>
			<th>Alpha</th>
		</tr>
		<?php $no=1; foreach($lap_kehadiran as $l) : ?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $l->nama_pegawai ?></td>
			<td><?php echo $l->nik ?></td>
			<td><?php echo $l->nama_jabatan ?></td>
			<td><?php echo $l->hadir ?></td>
			<td><?php echo $l->sakit ?></td>
			<td><?php echo $l->alpha ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
</body>
</html>

<script type="text/javascript">
	window.print();
</script>