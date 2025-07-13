<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Undian extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_undian');
    }

	public function index()
	{
		$id_toko		= $this->input->get('id_toko')? $this->input->get('id_toko'):'';
		$nik	= $this->input->get('nik')? $this->input->get('nik'):'';
		$data['nik'] = $nik;
		$data['list_hadiah'] = $this->m_undian->list_hadiah($id_toko);
		$this->load->view('undian_view',$data);
	}
	public function login_undian()
	{
		$this->load->view('login_undian_view');
	}
	
	public function register()
	{
		$data['title'] = "Customer";
		$data['konten'] = "Customer";
		$this->load->view('register_view');
	}
    function save_history_hadiah()
    {
		$id_hadiah = $this->security->xss_clean($this->input->post('id_hadiah'));
		$kode_voucher = strtolower($this->security->xss_clean($this->input->post('kode_voucher')));
		$id_toko = strtolower($this->security->xss_clean($this->input->post('id_toko')));
		$data_log = array(
			'id_toko'=> $id_toko, 
			'id_hadiah'=>$id_hadiah,
			'kode_voucher'=>$kode_voucher,
			'created_at'=>date('Y-m-d H:i:s'));
		$result = $this->m_undian->save_history_hadiah($data_log);
		$data_status = array(
			'status_voucher'=>"Terpakai",
			'id_hadiah'=>$id_hadiah
		);
        $this->db->where('kode_voucher', $kode_voucher);
        $this->db->update('voucher_hadiah', $data_status);
	}
    function get_status_voucher()
    {
		$id	= $this->input->get('id');

	}
    function get_id()
    {
		$id	= $this->input->get('id');
		$user = $this->db->get_where('voucher_hadiah', ['kode_voucher' => $id])->row_array();
		$data_r = array();
		if($user){
			$data_rsess = [
				'kode_voucher' => $user['kode_voucher'],
				'id_toko' => $user['id_toko'],
			];
			$this->session->set_userdata($data_rsess);
			$data_r = [
				'kode_voucher' => $user['kode_voucher'],
				'id_toko' => $user['id_toko'],
			];
			echo json_encode($data_r);
		}else{
			$data_r = [
				'kode_voucher' => "none",
				'id_toko' => "none",
			];
			
			echo json_encode($data_r);
		}
	}
	
    function get_spin()
    {
		$no_receip	= $this->input->post('no_receip');
		$data_cek			= $this->m_undian->get_spin($no_receip);
		$datas=$data_cek->row_array();
			$data_r = [
				'tot_spin' => $datas['tot_spin'],
				'kode_voucher' => $datas['kode_voucher'],
				'nama' => $datas['nama'],
			];
			echo json_encode($data_r);
    }
    function get_id_random()
    {
		$idToko	= $this->input->get('idToko');
		$id_voucher	= $this->input->get('id_voucher');
		$data_cek			= $this->m_undian->cek_voucher($id_voucher);
		
		if ($data_cek->num_rows() > 0) {
			$data2			= $this->m_undian->list_hadiah_rand($idToko);
			$data_hadiah				= array();
			$data_gambar				= array();
			$data_nama				= array();
			if ($data2->num_rows() > 0) {
				foreach ($data2->result_array() as $row) {
					$data_hadiah[] = $row['id_hadiah'];
					$data_gambar[] = $row['gambar'];
					$data_nama[] = $row['nama_hadiah'];
				}
			}
			$hadiahkey=array_rand($data_hadiah,1);
			$hadiah = $data_hadiah[$hadiahkey];
			$gambar = $data_gambar[$hadiahkey];
			$nama = $data_nama[$hadiahkey];
			$data_r= array(
				'urut_hadiah' => $hadiahkey+1,
				'hadiah' => $hadiah,
				'gambar' => $gambar,
				'nama' => $nama,
				'id' => $id_voucher,
			);
			echo json_encode($data_r);
		}else{
			$data_r= array(
				'urut_hadiah' => "-"
			);
			echo json_encode($data_r);
		}
	}
}
