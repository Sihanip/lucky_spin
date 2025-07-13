<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_add_customer extends CI_Model
{
    function list_toko()
    {
        $name=$this->session->userdata('name');
        $email=$this->session->userdata('email');
        if($name ==  "admin"){
            $this->db->select('*');
            $this->db->from('mst_toko');
            $this->db->order_by('mst_toko.id', 'DESC');
            $query = $this->db->get();
        }else{
            $query = $this->db->query("SELECT
            mst_toko.*
        FROM users
        inner join mst_toko on mst_toko.username_akses=users.email
        WHERE users.email = '$email' 
            ");  

        }
        $result = $query->result();        
        return $result;
    }
    function list_hadiah()
    {
        $this->db->select('*');
        $this->db->from('mst_hadiah');
        $this->db->order_by('mst_hadiah.id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    function get_toko($toko_id)
    {
        $this->db->select('*');
        $this->db->from('mst_toko');
        $this->db->where('id', $toko_id);
        $this->db->order_by('mst_toko.id', 'DESC');
        $query = $this->db->get();    
        return $query;
    }
    function get_add_customer($toko_id)
    {
		 $query = $this->db->query("SELECT
                *
            FROM user_customer
            WHERE (user_customer.id_toko = '$toko_id'  )
		 ");  
        return $query;
    }
    function get_cek_toko($id_toko,$id_hadiah)
    {
		 $query = $this->db->query("SELECT
                count(*) as total
            FROM hadiah_toko
            WHERE (hadiah_toko.id_toko = '$id_toko' AND  id_hadiah='$id_hadiah' )
		 ");  
        return $query;
    }
    function simpan_customer($data_cust)
    {
        $this->db->trans_start();
        $this->db->insert('user_customer', $data_cust);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    function add_stok($data_hadiah,$data_log,$id_toko,$id_hadiah)
    {
        $this->db->trans_start();
        $this->db->where('id_toko', $id_toko);
        $this->db->where('id_hadiah', $id_hadiah);
        $this->db->update('hadiah_toko', $data_hadiah);
        $this->db->trans_complete();
        
        $this->db->trans_start();
        $this->db->insert('log_add_stok', $data_log);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
    
        
        return $insert_id;
    }
    function edittoko($data_toko,$id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('mst_toko', $data_toko);
    
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
}