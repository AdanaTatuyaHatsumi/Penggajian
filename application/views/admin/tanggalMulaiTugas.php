
<div class="container-fluid" style="margin-bottom: 200px">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

   <?php echo $this->session->flashdata('pesan') ?>

   <a class="mb-2 mt-2 btn btn-sm btn-success" href="<?php echo base_url('admin/tanggalMulaiTugas/tambahData') ?>"><i class="fas fa-plus"></i>Tambah TMT</a>

   <table class="table table-striped table-bordered">
   	<tr>
   		<th class="text-center">No</th>
   		<th class="text-center">NIK</th>
   		<th class="text-center">Email</th>
   		<th class="text-center">Tanggal</th>
   		<th class="text-center">Status</th>
   		<th class="text-center">Action</th>
   	</tr>

   	<?php $no=1; foreach($tmt as $t) : ?>
   	<tr>
   		<td><?php echo $no++ ?></td>
   		<td><?php echo $t->nik ?></td>
		<td><?php echo $t->email ?></td>
		<td><?php echo $t->tanggal ?></td>
		<td>
		<?php if(empty($t->status_email)){ ?>
			<a href="<?php echo base_url('admin/tanggalMulaiTugas/emailNotif/'.$t->id) ?>" style="color: tomato;">Kirim?</a>
		<?php } else { echo $t->status_email; }?>			
		</td>
         <td>
			<?php if(empty($t->status_email)){ ?>
				<center>
					<a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/tanggalMulaiTugas/editData/'.$t->id) ?>"><i class="fas fa-edit"></i></a>
					<a onclick="return confirm('Yakin Hapus')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/tanggalMulaiTugas/deleteData/'.$t->id) ?>"><i class="fas fa-trash"></i></a>
				</center>
			<?php } else {?>
				-
			<?php } ?>
		</td>
   	</tr>
   	<?php endforeach; ?>
   </table>

</div>   