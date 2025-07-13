<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_toko extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_detail_toko');
        is_logged_in();
    }

	public function index()
	{
		$data['title'] = "Detail Toko";
		$data['konten'] = "Detail Toko";
		$data['list_toko'] = $this->m_detail_toko->list_toko();
		$data['list_hadiah'] = $this->m_detail_toko->list_hadiah();
		$this->load->view('template/header', $data);
		$this->load->view('detail_toko_view');
		$this->load->view('template/footer', $data);
	}
	
    function add_hadiah()
    {
		$id_toko = $this->security->xss_clean($this->input->post('id_toko_modal'));
		$id_hadiah = strtolower($this->security->xss_clean($this->input->post('select_hadiah')));
		$stok = strtolower($this->security->xss_clean($this->input->post('kuota_hadiah')));
		$data_hadiah = array('id_toko'=> $id_toko, 
		'id_hadiah'=>$id_hadiah,
		'stok'=>$stok,
		'created_at'=>date('Y-m-d H:i:s'));
		$result = $this->m_detail_toko->add_hadiah($data_hadiah);
		if($result > 0)
		{
			redirect('detail_toko');
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
        date_default_timezone_set('Asia/Jakarta');
        $date=date('Y-m-d H:i:s');
		$data_hadiah = array(
		'stok'=>$stok);
		$data_log = array(
		'id_toko'=>$id_toko,
		'id_hadiah'=>$id_hadiah,
		'add_stok'=>$add_stok,
		'stok_awal'=>$stok_awal,
		'stok'=>$stok,
		'created_at'=>$date
		);
		$result = $this->m_detail_toko->add_stok($data_hadiah,$data_log,$id_toko,$id_hadiah);
		if($result > 0)
		{
			echo json_encode("success");
			// redirect('detail_toko');
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
		$result = $this->m_detail_toko->edittoko($data_toko,$id);
		redirect('detail_toko');
	}
    function get_toko()
    {
		$toko_id	= $this->input->post('toko_id');
		$data1			= $this->m_detail_toko->get_toko($toko_id);
		$data				= array();
			if ($data1->num_rows() > 0) {
				foreach ($data1->result_array() as $row) {
					$data[] = $row;
				}
			}
		echo json_encode($data);
	}
    function get_detail_toko()
    {
		$toko_id	= $this->input->get('toko_id');
		$data1			= $this->m_detail_toko->get_detail_toko($toko_id);
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
		$data1			= $this->m_detail_toko->get_cek_toko($id_toko,$id_hadiah);
		$data				= array();
			if ($data1->num_rows() > 0) {
				foreach ($data1->result_array() as $row) {
					$data[] = $row;
				}
			}
		echo json_encode($data);
	}
}
