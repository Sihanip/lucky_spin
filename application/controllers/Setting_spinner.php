<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_spinner extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_setting_spinner');
        is_logged_in();
    }

	public function index()
	{
		$data['title'] = "Setting Spinner";
		$data['konten'] = "Setting Spinner";
		$data['list_toko'] = $this->m_setting_spinner->list_toko();
		$data['list_hadiah'] = $this->m_setting_spinner->list_hadiah();
		$this->load->view('template/header', $data);
		$this->load->view('setting_spinner_view');
		$this->load->view('template/footer', $data);
	}
	
    function update_hadiah()
    {
		$username_toko = $this->security->xss_clean($this->input->post('username_toko'));
		$id_hadiah = strtolower($this->security->xss_clean($this->input->post('id_hadiah')));
		$no_spinner = strtolower($this->security->xss_clean($this->input->post('no_spinner')));
		$data_hadiah = array(
		'id_hadiah'=>$id_hadiah);
		$result = $this->m_setting_spinner->update_hadiah($data_hadiah,$username_toko,$no_spinner);
		if($result > 0)
		{
			// echo json_encode("success");
		}
		else
		{
		}
	}
    function add_stok()
    {
		$id_hadiah = $this->security->xss_clean($this->input->post('id_hadiah_add2'));
		$id_toko = strtolower($this->security->xss_clean($this->input->post('id_toko_add2')));
		$stok_awal = strtolower($this->security->xss_clean($this->input->post('stok_sekarang_add2')));
		$add_stok = strtolower($this->security->xss_clean($this->input->post('tambah_stok')));
		$stok = strtolower($this->security->xss_clean($this->input->post('total_stok2')));
		$data_hadiah = array(
		'stok'=>$stok);
		$data_log = array(
		'id_toko'=>$id_toko,
		'id_hadiah'=>$id_hadiah,
		'add_stok'=>$add_stok,
		'stok_awal'=>$stok_awal,
		'stok'=>$stok,
		'created_at'=>date('Y-m-d H:i:s')
		);
		$result = $this->m_setting_spinner->add_stok($data_hadiah,$data_log,$id_toko,$id_hadiah);
		if($result > 0)
		{
			echo json_encode("success");
			// redirect('setting_spinner');
		}
		else
		{
		}
	}
    function edittoko()
    {
		$nama_toko = $this->security->xss_clean($this->input->post('nama_toko_edit'));
		$alamat_toko = strtolower($this->security->xss_clean($this->input->post('alamat_toko_edit')));
		$username_akses = strtolower($this->security->xss_clean($this->input->post('username_akses_edit')));
		$kode_akses = strtolower($this->security->xss_clean($this->input->post('kode_akses_edit')));
		$id = strtolower($this->security->xss_clean($this->input->post('id_toko_edit')));
		$data_toko = array('nama_toko'=> $nama_toko, 'alamat_toko'=>$alamat_toko,
		'username_akses'=>$username_akses,
		'kode_akses'=>$kode_akses,);
		$result = $this->m_setting_spinner->edittoko($data_toko,$id);
		redirect('setting_spinner');
	}
    function get_toko()
    {
		$toko_id	= $this->input->post('toko_id');
		$data1			= $this->m_setting_spinner->get_toko($toko_id);
		$data				= array();
			if ($data1->num_rows() > 0) {
				foreach ($data1->result_array() as $row) {
					$data[] = $row;
				}
			}
		echo json_encode($data);
	}
    function get_setting_spinner()
    {
		$toko_id	= $this->input->get('toko_id');
		$data1			= $this->m_setting_spinner->get_setting_spinner($toko_id);
		$data				= array();
			if ($data1->num_rows() > 0) {
				foreach ($data1->result_array() as $row) {
					$data[] = $row;
				}
			}
		echo json_encode($data);
	}
    function get_cek_toko()
    {
		$id_toko	= $this->input->post('id_toko');
		$id_hadiah	= $this->input->post('id_hadiah');
		$data1			= $this->m_setting_spinner->get_cek_toko($id_toko,$id_hadiah);
		$data				= array();
			if ($data1->num_rows() > 0) {
				foreach ($data1->result_array() as $row) {
					$data[] = $row;
				}
			}
		echo json_encode($data);
	}
}
