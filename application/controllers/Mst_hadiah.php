<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mst_hadiah extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_mst_hadiah');
        is_logged_in();
    }

	public function index()
	{
		$data['title'] = "Master Hadiah";
		$data['konten'] = "Master Hadiah";
		$data['list_hadiah'] = $this->m_mst_hadiah->list_hadiah();
		$this->load->view('template/header', $data);
		$this->load->view('mst_hadiah_view');
		$this->load->view('template/footer', $data);
	}
	
    function save_newhadiah()
    {
		$nama_hadiah = $this->security->xss_clean($this->input->post('nama_hadiah'));
		$stok_awal = $this->security->xss_clean($this->input->post('stok_awal'));
		
		$file_name = str_replace('.','',$nama_hadiah);
		$config['upload_path']          = FCPATH.'/assets/upload/';
		$config['allowed_types']        = 'gif|jpg|jpeg|png';
		$config['file_name']            = $file_name;
		$config['overwrite']            = true;
		$config['max_size']             = 2024; // 1MB
		
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data['error'] = $this->upload->display_errors();
			echo "Error";
		} else {
			$uploaded_data = $this->upload->data();

			$data_hadiah = array(
				'nama_hadiah'=> $nama_hadiah, 
				'stok_awal'=> $stok_awal, 
			'gambar'=>$uploaded_data['file_name'],
			'created_at'=>date('Y-m-d H:i:s'));
	
			if ($this->m_mst_hadiah->save_newtoko($data_hadiah)) {
				// $this->session->set_flashdata('message', 'Avatar updated!');
				redirect('Mst_hadiah');
			}else{
			}
		}

	}
    function edithadiah()
    {
		$nama_hadiah = $this->security->xss_clean($this->input->post('nama_hadiah_edit'));
		$stok_awal_edit = strtolower($this->security->xss_clean($this->input->post('stok_awal_edit')));
		$id = strtolower($this->security->xss_clean($this->input->post('id_hadiah_edit')));
		$data_hadiah = array('nama_hadiah'=> $nama_hadiah,'stok_awal'=> $stok_awal_edit,);
		$result = $this->m_mst_hadiah->edittoko($data_hadiah,$id);
		redirect('Mst_hadiah');
	}
    function get_hadiah()
    {
		$toko_id	= $this->input->post('toko_id');
		$data1			= $this->m_mst_hadiah->get_hadiah($toko_id);
		$data				= array();
			if ($data1->num_rows() > 0) {
				foreach ($data1->result_array() as $row) {
					$data[] = $row;
				}
			}
		echo json_encode($data);
	}
}
