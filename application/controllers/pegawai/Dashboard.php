<?php  

class Dashboard extends CI_Controller{

	public function __construct(){
		parent::__construct();

		if($this->session->userdata('hak_akses') !='2') {
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  	<strong>Anda belum login!</strong> 
	  			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>');
				redirect('welcome');
		}
	}

	public function index()
	{
		$data['title'] = "Dashboard";
		$id=$this->session->userdata('id_pegawai');
		$data['pegawai'] = $this->db->query("SELECT * FROM 
			data_pegawai WHERE id_pegawai='$id'")->result();
		$this->load->view('templates_pegawai/header',$data);
		$this->load->view('templates_pegawai/sidebar');
		$this->load->view('pegawai/dashboard',$data);
		$this->load->view('templates_pegawai/footer');
	}
	public function updateFoto(){
		$id 				= $this->input->post('id');
		$photo 				= $_FILES['photo']['name'];
			if($photo=''){}else{
				$config['upload_path'] 	= './assets/photo';
				$config['allowed_types'] = 'jpg|jpeg|png|tiff';
				$this->load->library('upload',$config);
				if(!$this->upload->do_upload('photo')){
					echo "Photo Gagal diupload!";
				}else{
					$photo = $this->upload->data('file_name');
				}
			}
		$data = array(
			'photo' 		=> $photo
		);

		$where = array(
			'id_pegawai'	=> $id
		);

		$this->penggajianModel->update_data('data_pegawai',$data,$where);

		redirect('pegawai/dashboard');

		
	}
}

?>