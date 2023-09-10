<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> <?php echo $title ?></h1>
    </div>

    <div class="alert alert-success font-weight-bold mb-4" style="width: 65%">Sealamat datang, Anda login sebagai pegawai.</div>

    <div class="card" style="margin-bottom: 120px; width: 65%">
    	<div class="card header font-weight-bold bg-primary text-white">
    		Data Pegawai
    	</div>

    	<?php 
            $id = $this->session->userdata('id_pegawai');
            $cek = $this->db->query("SELECT * FROM data_pegawai WHERE id_pegawai = '$id'")->result();
            foreach($cek as $c) :
                $foto = $c->photo;
            endforeach;
            if ($foto == '') {
                $foto_profil = base_url('assets/photo/male.png');
            }else{
                $foto_profil = base_url('assets/photo/'.$foto);
            }
            
        ?>

    	<?php foreach ($pegawai as $p) : ?>

    	<div class="card-body">
	    		<div class="row">
	    		<div class="col-md-5">
	    			<img style="width: 250px" src="<?php echo $foto_profil ?>">
					<div class="text-center" style="margin-top: 10px;">
						<!-- Button trigger modal -->
					<a class="" style="text-decoration: none; color: black;" data-toggle="modal" data-target="#exampleModal">
						Ganti Foto Profil?
						</a>
					</div>
	    		</div>
	    		
	    		<div class="col-md-7">
	    			<table class="table">
	    				<tr>
	    					<td>Nama Pegawai</td>
	    					<td>:</td>
	    					<td><?php echo $p->nama_pegawai ?></td>
	    				</tr>

	    				<tr>
	    					<td>Jabatan</td>
	    					<td>:</td>
	    					<td><?php echo $p->jabatan ?></td>
	    				</tr>

	    				<tr>
	    					<td>Tanggal Masuk</td>
	    					<td>:</td>
	    					<td><?php echo $p->tanggal_masuk ?></td>
	    				</tr>

	    				<tr>
	    					<td>Status</td>
	    					<td>:</td>
	    					<td><?php echo $p->status ?></td>
	    				</tr>
	    			</table>
	    		</div>
    		</div>
    	</div>
    <?php endforeach; ?>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ganti Foto Profil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form method="POST" action="<?php echo base_url('pegawai/dashboard/updateFoto') ?>" enctype="multipart/form-data">
      <div class="modal-body">
       <div class="card-body">
		<div class="form-group">
			<label>Masukan Photo</label>
			<?php foreach($pegawai as $p) : ?>
				<input type="hidden" name="id" class="form-control" value="<?php echo $p->id_pegawai ?>">
				<?php endforeach; ?>
			<input type="file" name="photo" class="form-control">
		</div>
	   </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
	</form>
      </div>
    </div>
  </div>
</div>

</div>