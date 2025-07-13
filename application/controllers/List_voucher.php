<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_voucher extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_list_voucher');
        is_logged_in();
    }

	public function index()
	{
		$data['title'] = "List Voucher";
		$data['konten'] = "List Voucher";
		$data['list_toko'] = $this->m_list_voucher->list_toko();
		$data['list_hadiah'] = $this->m_list_voucher->list_hadiah();
		$this->load->view('template/header', $data);
		$this->load->view('list_voucher_view');
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
		$result = $this->m_list_voucher->add_hadiah($data_hadiah);
		if($result > 0)
		{
			redirect('list_voucher');
		}
		else
		{
		}
	}
    function simpan_customer()
    {
		$id_toko_modal = $this->security->xss_clean($this->input->post('id_toko_modal'));
		$nama = strtolower($this->security->xss_clean($this->input->post('nama')));
		$no_wa = strtolower($this->security->xss_clean($this->input->post('no_wa')));
		$no_inv = strtolower($this->security->xss_clean($this->input->post('no_inv')));
		$total_belanja = strtolower($this->security->xss_clean($this->input->post('total_belanja')));
		$voucher_generated = strtolower($this->security->xss_clean($this->input->post('voucher_generated')));

		$data_cust = array(
		'id_toko'=>$id_toko_modal,
		'no_invoice'=>$no_inv,
		'voucher_generate'=>$voucher_generated,
		'total_belanja'=>$total_belanja,
		'no_wa'=>$no_wa,
		'nama'=>$nama,
		'created_at'=>date('Y-m-d H:i:s')
		);
		$result = $this->m_list_voucher->simpan_customer($data_cust);
		
		for ($x = 1; $x <= $voucher_generated; $x++) {
			$data_voucher = array(
				'id_toko'=>$id_toko_modal,
				'no_wa'=>$no_wa,
				'kode_voucher'=>$no_wa.$x,
			);
			$this->db->insert('voucher_hadiah', $data_voucher);
		}
		if($result > 0)
		{
			echo json_encode("success");
			// redirect('list_voucher');
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
		$result = $this->m_list_voucher->edittoko($data_toko,$id);
		redirect('list_voucher');
	}
    function get_toko()
    {
		$toko_id	= $this->input->post('toko_id');
		$data1			= $this->m_list_voucher->get_toko($toko_id);
		$data				= array();
			if ($data1->num_rows() > 0) {
				foreach ($data1->result_array() as $row) {
					$data[] = $row;
				}
			}
		echo json_encode($data);
	}
    function get_list_voucher()
    {
		$toko_id	= $this->input->get('toko_id');
		$data1			= $this->m_list_voucher->get_list_voucher($toko_id);
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
		$data1			= $this->m_list_voucher->get_cek_toko($id_toko,$id_hadiah);
		$data				= array();
			if ($data1->num_rows() > 0) {
				foreach ($data1->result_array() as $row) {
					$data[] = $row;
				}
			}
		echo json_encode($data);
	}
}
