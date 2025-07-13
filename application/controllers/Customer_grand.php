<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_grand extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_customer_grand');
        // is_logged_in();
    }

	public function index()
	{
		$data['title'] = "Customer";
		$data['konten'] = "Customer";
		$data['list_cust'] = $this->m_customer_grand->get_list_customer();
		$this->load->view('template/header', $data);
		$this->load->view('customer_grand_view');
		$this->load->view('template/footer', $data);
	}
// 	public function register()
// 	{
// 		$data['title'] = "Customer";
// 		$data['konten'] = "Customer";
// 		$this->load->view('register_view');
// 	}
	
    function add_hadiah()
    {
		$id_toko = $this->security->xss_clean($this->input->post('id_toko_modal'));
		$id_hadiah = strtolower($this->security->xss_clean($this->input->post('select_hadiah')));
		$stok = strtolower($this->security->xss_clean($this->input->post('kuota_hadiah')));
        date_default_timezone_set('Asia/Makassar');
		$data_hadiah = array('id_toko'=> $id_toko, 
		'id_hadiah'=>$id_hadiah,
		'stok'=>$stok,
		'created_at'=>date('Y-m-d H:i:s'));
		$result = $this->m_customer_grand->add_hadiah($data_hadiah);
		if($result > 0)
		{
			redirect('customer_grand');
		}
		else
		{
		}
	}
    function simpan_customer()
    {
		$id_toko = $this->security->xss_clean($this->input->post('id_toko'));
		$nama = strtolower($this->security->xss_clean($this->input->post('nama')));
		$no_telp = strtolower($this->security->xss_clean($this->input->post('no_telp')));
		$no_receip = strtolower($this->security->xss_clean($this->input->post('no_receip')));
		$nominal_beli = strtolower($this->security->xss_clean($this->input->post('nominal_beli')));
		$email = strtolower($this->security->xss_clean($this->input->post('email')));
		$nama_barang = strtolower($this->security->xss_clean($this->input->post('nama_barang')));
		$nik = strtolower($this->security->xss_clean($this->input->post('nik')));
		$nominal_beli = strtolower($this->security->xss_clean($this->input->post('nominal_beli')));
		$total_spin = 1;
		
        date_default_timezone_set('Asia/Jakarta');
        $date=date('Y-m-d H:i:s');
		$data_cust = array(
		'id_toko'=>$id_toko,
		'nama'=>$nama,
		'no_telp'=>$no_telp,
		'email'=>$email,
		'no_receipt'=>$no_receip,
		'nama_barang'=>$nama_barang,
		'no_identitas'=>$nik,
		'status'=>'1',
		'nominal_beli'=>$nominal_beli,
		'total_spin'=>$total_spin,
		'created_at'=>$date
		);
		
		$user_cek = $this->db->get_where('customer_grand', ['no_receipt' => $no_receip])->row_array();
		if ($user_cek) {
    			$data_rsess = [
    				'no_receip' => $no_receip,
    				'id_toko' => $id_toko,
    			];
    			$this->session->set_userdata($data_rsess);
    			echo json_encode("success");
		}else{
    		$result = $this->m_customer_grand->simpan_customer($data_cust);
    			$data_rsess = [
    				'no_receip' => $no_receip,
    				'id_toko' => $id_toko,
    			];
    			$this->session->set_userdata($data_rsess);
    		
    		for ($x = 1; $x <= $total_spin; $x++) {
    			$data_voucher = array(
    				'id_toko'=>$id_toko,
    				'id_customer'=>$no_receip,
    				'no_wa'=>$no_receip,
    				'kode_voucher'=>$no_receip.$x,
    			);
    			$this->db->insert('voucher_hadiah', $data_voucher);
    		}
    		if($result > 0)
    		{
    			echo json_encode("success");
    			// redirect('customer_grand');
    		}
    		else
    		{
    		}
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
		$result = $this->m_customer_grand->edittoko($data_toko,$id);
		redirect('customer_grand');
	}
    function get_list_customer()
    {
		$data1			= $this->m_customer_grand->get_list_customer();
		$data				= array();
			if ($data1->num_rows() > 0) {
				foreach ($data1->result_array() as $row) {
					$data[] = $row;
				}
			}
		echo json_encode($data);
	}
    function get_kode_toko()
    {
		$kode_toko = $this->security->xss_clean($this->input->post('kode_toko'));
		$data1			= $this->m_customer_grand->get_toko($kode_toko);
		$data				= array();
			if ($data1->num_rows() > 0) {
				foreach ($data1->result_array() as $row) {
					$data[] = $row;
				}
			}
		echo json_encode($data);
	}
    function get_no_receip()
    {
		$no_receip = $this->security->xss_clean($this->input->post('no_receip'));
		$data1			= $this->m_customer_grand->get_no_receip($no_receip);
		$data				= array();
			if ($data1->num_rows() > 0) {
				foreach ($data1->result_array() as $row) {
					$data[] = $row;
				}
			}
		echo json_encode($data);
	}
}
