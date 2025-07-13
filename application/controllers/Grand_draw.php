<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grand_draw extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_grand_draw');
    }

	public function index()
	{
		$data['title'] = "Setting Spinner";
		$data['konten'] = "Setting Spinner";
		$data['list_user'] = $this->m_grand_draw->list_user();
		$this->load->view('grand_draw_view',$data);
	}
	public function list_winner()
	{
		$data['title'] = "Setting Spinner";
		$data['konten'] = "Setting Spinner";
		$data['list_user'] = $this->m_grand_draw->list_winner()->result();
		$this->load->view('grand_draw_win_view',$data);
	}
	
    function get_user()
    {
		$data_cek			= $this->m_grand_draw->get_user();
		$data				= array();
			if ($data_cek->num_rows() > 0) {
				foreach ($data_cek->result_array() as $row) {
					$data[] = $row;
				}
			}
		echo json_encode($data);
    }
    function list_menang()
    {
		$data_cek			= $this->m_grand_draw->list_menang();
		$data				= array();
			if ($data_cek->num_rows() > 0) {
				foreach ($data_cek->result_array() as $row) {
					$data[] = $row;
				}
			}
		echo json_encode($data);
    }
    function penerima_grand()
    {
		$hadiah = $this->security->xss_clean($this->input->post('hadiah'));
		$id_user = $this->security->xss_clean($this->input->post('id_user'));
		$data_hadiah = array(
		'id_user'=>$id_user,
		'hadiah'=>$hadiah,
		);
		$result = $this->m_grand_draw->penerima_grand($data_hadiah);
		if($result > 0)
		{
		}
		else
		{
		}
	}
    function delete_id()
    {
		$id = $this->security->xss_clean($this->input->get('id'));
    $this->db->where('id', $id);
    $this->db->delete('penerima_grand');
		redirect('Grand_draw/list_winner');
	}
}
