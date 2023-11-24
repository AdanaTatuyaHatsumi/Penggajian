<?php

class tanggalMulaiTugas extends CI_Controller{
    public function __construct(){
		parent::__construct();
		if($this->session->userdata('hak_akses') != '1'){

			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Anda belum login</strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>');
				redirect('welcome');
		}
	}
    public function index(){
        $data['title'] = "Tanggal Mulai Tugas";
		$data['tmt'] = $this->penggajianModel->get_data('tmt')->result();
		$this->load->view('templates_admin/header',$data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/tanggalMulaiTugas',$data);
		$this->load->view('templates_admin/footer');
    }
    public function tambahData(){
        $data['title'] = "Tambah Data TMT";
		$data['pegawai'] = $this->penggajianModel->get_data('data_pegawai')->result();
		$this->load->view('templates_admin/header',$data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/formTambahTmt',$data);
		$this->load->view('templates_admin/footer');
    }
    public function tambahDataAksi(){
        $this->_rules();

		if($this->form_validation->run() == FALSE){
			$this->tambahData();
		}else{
			$nik 				= $this->input->post('nik');
			$cek 				= $this->db->query("SELECT * FROM data_pegawai WHERE nik = '$nik'")->result();
			foreach($cek as $c) :
				$email 			= $c->email; 
			endforeach;
			$tanggal 			= $this->input->post('tanggal');

			$data = array(
				'nik' 						=> $nik,
				'email' 					=> $email,
				'tanggal' 					=> $tanggal,
			);

			$this->penggajianModel->insert_data($data,'tmt');
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>Data berhasil ditambahkan!</strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>');

			redirect('admin/tanggalMulaiTugas');
		}
    }
	public function editData($id){
		$data['title'] = "Edit Data TMT";
		$data['pegawai'] = $this->penggajianModel->get_data('data_pegawai')->result();
		$data['tmt'] 	 = $this->db->query("SELECT * FROM tmt WHERE id = '$id'")->result();
		$this->load->view('templates_admin/header',$data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/updateTmt',$data);
		$this->load->view('templates_admin/footer');
	}
	public function editDataAksi(){
        $this->_rules();

		$id 				= $this->input->post('id');

		if($this->form_validation->run() == FALSE){
			$this->editData($id);
		}else{
			$nik 				= $this->input->post('nik');
			$cek 				= $this->db->query("SELECT * FROM data_pegawai WHERE nik = '$nik'")->result();
			foreach($cek as $c) :
				$email 			= $c->email; 
			endforeach;
			$tanggal 			= $this->input->post('tanggal');

			$data = array(
				'nik' 						=> $nik,
				'email' 					=> $email,
				'tanggal' 					=> $tanggal,
			);

			$where = array(
				'id'						=> $id,
			);

			$this->penggajianModel->update_data('tmt',$data,$where);
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Data berhasil diupdate!</strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>');

			redirect('admin/tanggalMulaiTugas');
		}
    }
	public function deleteData($id){
		$where = array('id' => $id);
		$this->penggajianModel->delete_data($where,'tmt');
		$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Data berhasil dihapus!</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>');

		redirect('admin/tanggalMulaiTugas');
	}
    public function _rules(){
		$this->form_validation->set_rules('nik','Nik','required');
		$this->form_validation->set_rules('tanggal','Tanggal','required');
    }
	public function emailNotif($id){

		$cek = $this->db->query("SELECT * FROM tmt WHERE id = '$id'")->result();
		foreach ($cek as $c) :
			$email   = $c->email;
			$tanggal = $c->tanggal;
		endforeach;
		
		$this->Email->email($email,$tanggal);

		$status_email			= 'terkirim';
		$data = array(
			'status_email'		=> $status_email,
		);
		$where = array(
			'id'				=> $id,
		);

		$this->penggajianModel->update_data('tmt',$data,$where);

		redirect('admin/tanggalMulaiTugas');
	}
}

?>