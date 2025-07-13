<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mst_toko extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_mst_toko');
        $this->load->library('Pdf');
        is_logged_in();
    }

	public function index()
	{
		$data['title'] = "Master Toko";
		$data['konten'] = "Master Toko";
		$data['list_toko'] = $this->m_mst_toko->list_toko();
		$this->load->view('template/header', $data);
		$this->load->view('mst_toko_view');
		$this->load->view('template/footer', $data);
	}
	
    function save_newtoko()
    {
		$nama_toko = $this->security->xss_clean($this->input->post('nama_toko'));
		$alamat_toko = strtolower($this->security->xss_clean($this->input->post('alamat_toko')));
		$username_akses = strtolower($this->security->xss_clean($this->input->post('username_akses')));
		$kode_akses = strtolower($this->security->xss_clean($this->input->post('kode_akses')));
		$data_toko = array('nama_toko'=> $nama_toko, 
		'alamat_toko'=>$alamat_toko,
		'username_akses'=>$username_akses,
		'kode_akses'=>$kode_akses,
		'created_at'=>date('Y-m-d H:i:s'));
		$result = $this->m_mst_toko->save_newtoko($data_toko);
		$data = [
			'name' => htmlspecialchars($this->input->post('nama_toko', true)),
			'email' => htmlspecialchars($this->input->post('username_akses', true)),
			'password' => password_hash($this->input->post("kode_akses"), PASSWORD_DEFAULT),
			'role_id' => 3,
			'username_toko' => htmlspecialchars($this->input->post('username_akses', true)),
		];
		$this->db->insert('users', $data);
		for ($x = 1; $x <= 8; $x++) {
			$data_hadiah = array(
			'no_spinner'=> $x, 
			'username_toko'=>$username_akses);
			$this->db->insert('setting_spinner', $data_hadiah);
		}
		if($result > 0)
		{
			redirect('Mst_toko');
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
		$result = $this->m_mst_toko->edittoko($data_toko,$id);
		redirect('Mst_toko');
	}
    function get_toko()
    {
		$toko_id	= $this->input->post('toko_id');
		$data1			= $this->m_mst_toko->get_toko($toko_id);
		$data				= array();
			if ($data1->num_rows() > 0) {
				foreach ($data1->result_array() as $row) {
					$data[] = $row;
				}
			}
		echo json_encode($data);
	}
    function print_mst_toko()
    {
		$toko_id	= $this->input->post('toko_id');
		$data1			= $this->m_mst_toko->list_toko($toko_id);
        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf = new FPDF('P', 'mm','Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(0,7,'Store List',0,1,'C');
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(100,6,'Store Name',1,0,'C');
        $pdf->Cell(40,6,'Acces Code',1,0,'C');
        $pdf->Cell(40,6,'Region',1,1,'C');
        $pdf->SetFont('Arial','',10);
        // // $pegawai = $this->db->get('pegawai')->result();
        // // $no=0;
        foreach ($data1 as $data){
            $no++;
            $pdf->Cell(10,6,$no,1,0, 'C');
            $pdf->Cell(100,6,$data->nama_toko,1,0);
            $pdf->Cell(40,6,$data->kode_akses,1,0);
            $pdf->Cell(40,6,$data->alamat_toko,1,1);
        }
        $pdf->Output();
	}
}
